<?php

/**
 * Base Ginger Gateway
 * The {bank_name}Gateway class must extend this one and if needed override some methods.
 */
class baseGingerGateway extends GingerRefund
{
    /**
     * Module version.
     *
     * @var string
     */
    public $moduleVersion = "1.3.4";

    /**
     * @var /Ginger/ApiClient Ginger Payments SDK client
     */
    protected $ginger;

    /**
     * @var string
     */
    protected $method;

    public $code;

    /**
     * Check if AfterPay payment method is limited to specific set of IPs.
     *
     * @param $order
     * @return mixed
     */
    public function gingerAfterPayCountriesValidation($order): bool
    {
        $gingerAfterPayCountriesList = constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_COUNTRIES_AVAILABLE");
        if (empty($gingerAfterPayCountriesList)) {
            return true;
        } else {
            $countrylist = array_map("trim", explode(',', $gingerAfterPayCountriesList));
            return in_array($order->billing['country']['iso_code_2'], $countrylist);
        }
    }

    public function gingerCurrenciesValidation($order): bool
    {
        global $messageStack;

        $order_currency = $order->info['currency'];
        try {
            $this->ginger = $this->getClient();
            $currencies = $this->ginger->getCurrencyList();
            $ginger_available_currency = $currencies['payment_methods'][constant("GINGER_PAYMENT_MAPPING")[$this->getMethodNameFromCode()]]['currencies'];
            if (in_array($order_currency, $ginger_available_currency)) {
                return true;
            } else {
                $messageStack->add_session('checkout_payment', 'Some payment methods is not supported for selected currency', 'caution');
                return false;
            }
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', 'Error while applying currency check, message : ' . $exception->getMessage(), 'warning');
            exit;
        }
    }

    /**
     * Get selected IssuerId from checkout page
     *
     * @return string
     */
    public function getIssuerId()
    {
        return zen_output_string_protected($_POST['issuer_id']);
    }

    /**
     * Get custom fields for AfterPay payment method for checkout page
     *
     * @return array[]
     */
    public function getAfterPayFields(): array
    {
        global $order;

        return [
            [
                'title' => constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_DOB"),
                'field' => zen_draw_input_field($this->code . '_dob')
            ], [
                'title' => constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_GENDER"),
                'field' => zen_draw_pull_down_menu(
                    $this->code . '_gender',
                    [
                        ['id' => '', 'text' => ''],
                        ['id' => 'male', 'text' => constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_MALE")],
                        ['id' => 'female', 'text' => constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_FEMALE")]
                    ]
                )
            ],
            [
                'title' => sprintf('%s <a href="%s">%s</a>', constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_I_ACCEPT"), $this->getTermsAndConditionUrlByCountryIso2Code($order->billing['country']['iso_code_2']), constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_TERMS_AND_CONDITIONS")),
                'field' => zen_draw_checkbox_field($this->code . '_terms_and_conditions')
            ]
        ];
    }

    /**
     * Save Bank References for BankTransfer order
     *
     * @param $gingerOrder
     */
    public function saveBankReferences($gingerOrder)
    {
        $bankReference = current($gingerOrder['transactions'])['payment_method_details']['reference'];
        $_SESSION[$this->code . '_reference'] = $bankReference;
        $_SESSION[$this->code . '_order_id'] = current($gingerOrder['transactions'])['order_id'];
        $_SESSION['payment_method_messages'] = str_replace(
            '{{reference}}',
            $bankReference,
            constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_INFORMATION")
        );
    }

    /**
     * Method clears off the cart.
     */
    protected function emptyCart()
    {
        global $order_total_modules;

        $_SESSION['cart']->reset(true);

        unset($_SESSION['sendto']);
        unset($_SESSION['billto']);
        unset($_SESSION['shipping']);
        unset($_SESSION['payment']);
        unset($_SESSION['comments']);
        unset($_SESSION['cot_gv']);

        $order_total_modules->clear_posts();
    }

    /**
     * Initiate Ginger API client.
     *
     * @param string $code
     * @return \Ginger\ApiClient
     */
    public static function getApiKey($code = GINGER_BANK_PREFIX)
    {
        if (defined("MODULE_PAYMENT_GINGER_KLARNA_TEST_API_KEY") && strlen(constant("MODULE_PAYMENT_GINGER_KLARNA_TEST_API_KEY")) === 32 && $code == constant("GINGER_BANK_PREFIX") . '_klarnapaylater') {
            $apiKey = constant("MODULE_PAYMENT_GINGER_KLARNA_TEST_API_KEY");
        } elseif (defined("MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY") && strlen(constant("MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY")) === 32 && $code == constant("GINGER_BANK_PREFIX") . '_afterpay') {
            $apiKey = constant("MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY");
        } elseif (defined("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_API_KEY")) {
            $apiKey = constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_API_KEY");
        } else {
            $apiKey = null;
        }

        return strlen($apiKey) == 32 ? $apiKey : null;
    }

    /**
     *  Getting CaCert path
     *
     */
    public static function getCaCertPath(): string
    {
        return dirname(__DIR__) . '/vendors/assets/cacert.pem';
    }

    /**
     * Check if AfterPay payment method is limited to specific set of IPs.
     *
     * @return bool
     */
    public function gingerAfterPayIpFiltering(): bool
    {
        $gingerAfterPayIpList = constant("MODULE_PAYMENT_" . ($this->code) . "_IP_FILTERING");

        if (strlen($gingerAfterPayIpList) > 0) {
            $ip_whitelist = array_map('trim', explode(",", $gingerAfterPayIpList));
            if (!in_array($_SESSION['customers_ip_address'], $ip_whitelist)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get user agent of the user.
     * @return string
     */
    public function getUserAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Return constant platform name ZenCart
     *
     * @return string
     */
    public function getPlatformName(): string
    {
        return 'ZenCart';
    }

    /**
     * Get platform version using such constant as for Admin -> Tools -> Server information.
     *
     * @return string
     */
    public function getPlatformVersion(): string
    {
        return implode('.', [constant("PROJECT_VERSION_MAJOR"), constant("PROJECT_VERSION_MINOR")]);
    }

    /**
     * Update order status and link ginger order to existing ZenCart order.
     *
     * @param $order
     */
    public function saveOrderInHistory($order)
    {
        static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($order));
        static::addOrderHistory($this->getOrderId(), static::getZenStatusId($order), current($order['transactions'])['order_id']);
    }

    /**
     * Method retrieves custom field from POST array.
     *
     * @param string $field
     * @return string|null
     */
    public function getCustomPaymentField(string $field)
    {
        if (array_key_exists($field, $_POST) && strlen($_POST[$field]) > 0) {
            return zen_output_string_protected($_POST[$field]);
        }
        return null;
    }

    /**
     * Get plugin version from constant in this class.
     * @return string
     */
    public function getPluginVersion(): string
    {
        return $this->moduleVersion;

    }

    /**
     * Basically saves the ZenCart order with it status.
     * Also, could be used for link ginger order id with zen cart order.
     *
     * @param int $orderId
     * @param int $orderStatus
     * @param string $comment
     */
    public static function addOrderHistory(int $orderId, int $orderStatus, $comment = '')
    {
        global $db;

        $sql = "INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . " 
                    (comments, orders_id, orders_status_id, customer_notified, date_added) 
                VALUES 
                    (:orderComments, :orderID, :orderStatus, -1, now());";

        $sql = $db->bindVars($sql, ':orderComments', $comment, 'string');
        $sql = $db->bindVars($sql, ':orderID', $orderId, 'integer');
        $sql = $db->bindVars($sql, ':orderStatus', $orderStatus, 'integer');

        $db->Execute($sql);
    }

    /**
     * @param int $orderId
     * @param int $orderStatus
     */
    public static function updateOrderStatus(int $orderId, int $orderStatus)
    {
        global $db;

        $sql = "UPDATE " . TABLE_ORDERS . " 
                SET 
                    orders_status = ':orderStatus', 
                    last_modified = NOW()
                WHERE 
                    orders_id = ':orderId';";

        $sql = $db->bindVars($sql, ':orderId', $orderId, 'integer');
        $sql = $db->bindVars($sql, ':orderStatus', $orderStatus, 'integer');

        $db->Execute($sql);
    }

    /**
     * Obtain order history.
     *
     * @param int $orderId
     * @return array
     */
    public function getOrderHistory(int $orderId): array
    {
        global $db;

        $sql = "SELECT * 
                FROM " . TABLE_ORDERS_STATUS_HISTORY . " 
                WHERE `orders_id` = ':orderID';";

        $sql = $db->bindVars($sql, ':orderID', $orderId, 'integer');

        $history = [];
        $historyQuery = $db->Execute($sql);

        while (!$historyQuery->EOF) {
            $history[] = $historyQuery->fields;
            $historyQuery->MoveNext();
        }

        return $history;
    }

    /**
     * Map Ginger statuses to ZenCart.
     *
     * @param array $ginger_order
     * @return null
     */
    public static function getZenStatusId(array $ginger_order)
    {
        switch ($ginger_order['status']) {
            case 'completed' :
                return constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_ORDER_STATUS_COMPLETED");
            case 'error' :
                return constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_ORDER_STATUS_ERROR");
            case 'processing' :
                return constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_ORDER_STATUS_PROCESSING");
            case 'cancelled' :
                return constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_ORDER_STATUS_CANCELLED");
            default :
                return constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_ORDER_STATUS_PENDING");
        }
    }

    /**
     * Depending on order status user is getting redirected and order status is updated.
     *
     * @param string $gingerOrderId
     */
    public function statusRedirect(string $gingerOrderId)
    {
        global $messageStack;

        try {
            $gingerOrder = $this->ginger->getOrder($gingerOrderId);
            static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($gingerOrder));
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($gingerOrder), current($gingerOrder['transactions'])['order_id']);
            if ($gingerOrder['status'] == 'completed') {
                $this->emptyCart();
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
            } elseif ($gingerOrder['status'] == 'processing' || $gingerOrder['status'] == 'new') {
                zen_redirect(zen_href_link('ginger_pending', '', 'SSL'));
            } elseif ($gingerOrder['status'] == 'cancelled'
                || $gingerOrder['status'] == 'error'
                || $gingerOrder['status'] == 'expired'
            ) {
                $this->loadLanguageFile(constant("GINGER_BANK_PREFIX"));
                $customer_message = current($gingerOrder['transactions'])['customer_message'] ?: constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_ERROR_TRANSACTION");
                $messageStack->add_session('checkout_payment', $customer_message, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Method checks for availability in the current zone.
     *
     * @param int $modulePaymentZone
     */
    public function updateModuleVisibility($modulePaymentZone)
    {
        global $order, $db;

        if ($this->enabled && (int)$modulePaymentZone > 0 && isset($order->billing['country']['id'])) {
            $check_flag = false;

            $check_query = $db->Execute(
                "SELECT zone_id FROM "
                . TABLE_ZONES_TO_GEO_ZONES
                . " WHERE geo_zone_id = '"
                . $modulePaymentZone
                . "' AND zone_country_id = '"
                . (int)$order->billing['country']['id']
                . "' ORDER BY zone_id;"
            );

            while (!$check_query->EOF) {
                if ($check_query->fields['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
                $check_query->MoveNext();
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }

    /**
     * @return null
     */
    public function before_process()
    {
        return null;
    }

    /**
     * @return void
     */
    public function after_process()
    {
        return null;
    }

    /**
     * @return null
     */
    public function selection()
    {
        return null;
    }

    /**
     * @return null
     */
    public function confirmation()
    {
        return null;
    }

    /**
     * @return bool
     */
    public function check_referrer()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function get_error()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function pre_confirmation_check()
    {
        return false;
    }

    /**
     * @return null
     */
    public function javascript_validation()
    {
        return null;
    }

    /**
     * @return null
     */
    public function process_button()
    {
        return null;
    }

    /**
     * @return null
     */
    public function update_status()
    {
        return null;
    }

    protected function isKlarnaPayLater()
    {
        return $this->code == constant("GINGER_BANK_PREFIX") . '_klarnapaylater';
    }

    protected function isAfterPay()
    {
        return $this->code == constant("GINGER_BANK_PREFIX") . '_afterpay';
    }

    protected function isApplePay()
    {
        return $this->code == constant("GINGER_BANK_PREFIX") . '_applepay';
    }

    public function applePayDetection()
    {
        $a = "<script>
        if (!window.ApplePaySession) {
        document.cookie = 'ginger_apple_pay_status = false' 
        } else {
        document.cookie = 'ginger_apple_pay_status = true' 
        };
        </script>";
        echo $a;

        return $_COOKIE["ginger_apple_pay_status"] === 'true';
    }

    /**
     * @param $order
     * @return float|int
     */
    public function calculateShippingTax($order)
    {
        return ($order->info['shipping_tax'] * 100) / $order->info['shipping_cost'];
    }
}
