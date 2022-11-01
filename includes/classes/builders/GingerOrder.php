<?php

class GingerOrder extends GingerClient
{
    /**
     * Get Ginger order
     *
     * @return mixed
     */
    public function getGingerOrder()
    {
        global $order, $messageStack;

        try {
            $ginger_order = $this->ginger->createOrder($this->getInfoForGingerOrder($order));

            if ($this->isRequiredOrderLines()) {
                $this->saveOrderInHistory($ginger_order);
            }

            switch ($ginger_order['status']) {
                case 'error' :
                    $messageStack->add_session(
                        'checkout_payment',
                        current($ginger_order['transactions'])['customer_message'] ?? constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_ERROR_TRANSACTION"),
                        'error'
                    );
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
                    break;
                case 'canceled' :
                    $messageStack->add_session(
                        'checkout_payment',
                        constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_ERROR_TRANSACTION_IS_CANCELLED"),
                        'error'
                    );
                    break;
                default :
                    //Return the array, response, from Ginger API
                    return $ginger_order;
            }
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        } catch (Exception $exception) {
            $messageStack->add_session(
                'checkout_payment',
                $exception->getMessage(),
                'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Collect all required data which uses to create Ginger order.
     *
     * @param $order
     * @return array
     */
    public function getInfoForGingerOrder($order): array
    {
        return array_filter(
            [
                'amount' => $this->culc_amount($order->info),                                                     // amount in cents
                'currency' => $this->getCurrency($order),                                                            // currency
                'description' => $this->getOrderDescription(),                                                       // order description
                'merchant_order_id' => (string)$this->getOrderId(),                                                  // merchantOrderId
                'return_url' => $this->getReturnUrl(),                                                               // returnUrl
                'customer' => $this->getCustomerInfo($order), // customer
                'extra' => $this->getExtraArray(),
                'client' => $this->getClientArray(),                                                                   // extra information
                'webhook_url' => $this->getWebhookUrl(),                                                             // webhook_url
                'order_lines' => $this->isRequiredOrderLines() ? $this->getOrderLines($order) : null,                // order lines
                'transactions' => $this->getTransaction()
            ]);
    }

    /**
     * Convert system currency to EUR
     *
     * @param $amount
     * @return int
     */
    public function culc_amount($order_info)
    {
        return $this->getAmountInCents($order_info['total'] * $order_info['currency_value']);
    }

    /**
     * @param $amount
     * @return int
     */
    public function getAmountInCents($amount): int
    {
        return (int)round($amount * 100);
    }

    public function getAmountWithTax($final_price, $tax)
    {
        return $this->getAmountInCents(
            $final_price + zen_calculate_tax($final_price, $tax)
        );
    }

    public function getExtraArray()
    {
        return null;
    }

    /**
     * Get order currency.
     *
     * @param $order
     * @return mixed
     */
    public function getCurrency($order)
    {
        return $order->info['currency'];
    }

    /**
     * Generate order description.
     *
     * @return string
     */
    public function getOrderDescription(): string
    {
        if (defined('MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_DESCRIPTION')) {
            return sprintf(constant('MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_DESCRIPTION'), $this->getOrderId(), TITLE);
        } elseif (!empty($_POST['refnote'])) {
            return $_POST['refnote'];
        }
        return '';
    }

    /**
     * Retrieve order id from Session variables.
     *
     * @return int
     */
    public function getOrderId(): int
    {
        return (int)$_SESSION['order_summary']['order_number'];
    }

    /**
     * Generate return URL.
     *
     * @return bool|null|string
     */
    public function getReturnUrl()
    {
        return function_exists('zen_href_link') ? zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL') : 'localhost';
    }

    public function getProductUrl($product_id)
    {
        return zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_id);
    }

    /**
     * Obtain webhook URL based on site settings.
     *
     * @return string
     */
    public function getWebhookUrl(): string
    {
        if (ENABLE_SSL == 'true') {
            $url = HTTPS_SERVER;
        } else {
            $url = HTTP_SERVER;
        }
        return $url . '/' . 'ginger_webhook.php';
    }

    /**
     * @param $order
     * @return array
     */
    public function getCustomerInfo($order): array
    {
        $customer = array_filter([
            'address_type' => 'billing',
            'merchant_customer_id' => (string)$_SESSION['customer_id'],
            'email_address' => $order->customer['email_address'],
            'first_name' => $order->customer['firstname'],
            'last_name' => $order->customer['lastname'],
            'address' => trim($order->billing['street_address'])
                . ' ' . trim($order->billing['suburb'])
                . ' ' . trim($order->billing['postcode'])
                . ' ' . trim($order->billing['city']),
            'postal_code' => $order->billing['postcode'],
            'country' => $order->billing['country']['iso_code_2'],
            'phone_numbers' => [$order->customer['telephone']],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'ip_address' => $_SESSION['customers_ip_address'],
            'locale' => $_SESSION['languages_code'],
            'additional_address' => $this->getAdditionalAddress($order)
        ]);

        if ($this->isAfterPay()) $customer = array_merge($customer, $this->getAdditionalCustomerInfo());

        return $customer;
    }

    /**
     * Retrieve extra array which describes environment, where order was created.
     *
     * @return array
     */
    public function getClientArray(): array
    {
        return [
            'platform_name' => $this->getPlatformName(),
            'platform_version' => $this->getPlatformVersion(),
            'plugin_name' => getGingerPluginName(),
            'plugin_version' => $this->getPluginVersion(),
            'user_agent' => $this->getUserAgent(),
        ];
    }

    /**
     *
     */
    public function isRequiredOrderLines(): bool
    {
        return in_array($this->getMethodNameFromCode(), ['afterpay', 'klarnapaylater']);
    }

    /**
     * @param $order
     * @return array
     */
    public function getOrderShippingLine($order): array
    {
        return [
            'quantity' => 1,
            'amount' => $this->getAmountInCents($order->info['shipping_cost'] + $order->info['shipping_tax']),
            'name' => $order->info['shipping_method'],
            'type' => 'shipping_fee',
            'currency' => $this->getCurrency($order),
            'vat_percentage' => $this->getAmountInCents($this->calculateShippingTax($order)),
            'merchant_order_line_id' => (string)(count($order->products) + 1)
        ];
    }

    /**
     * Generate order lines from the order
     *
     * @param order $order
     * @return array|null
     */
    public function getOrderLines($order): array
    {
        $orderLines = [];
        foreach ($order->products as $product) {
            $orderLines[] = [
                'name' => (string)$product['name'],
                'currency' => $this->getCurrency($order),
                'type' => 'physical',
                'amount' => $product['amount'] ?? $this->getAmountWithTax($product['final_price'], $product['tax']),
                'vat_percentage' => $this->getAmountInCents($product['tax']),
                'quantity' => (int)$product['qty'],
                'merchant_order_line_id' => (string)$product['id'],
                'url' => $product['url'] ?? $this->getProductUrl($product['id'])
            ];
        }

        if ($order->info['shipping_cost'] > 0) {
            $orderLines[] = $this->getOrderShippingLine($order);
        }

        return $orderLines;
    }

    /**
     * Collect data about transaction.
     *
     * @return array
     */
    public function getTransaction()
    {
        return array_filter([
            array_filter([
                'payment_method' => constant("GINGER_PAYMENT_MAPPING")[$this->getMethodNameFromCode()],
                'payment_method_details' => $this->getPaymentDetails()
            ])
        ]);
    }

    /**
     * Simple exploding payment code to extract payment method name.
     *
     * @return string|null
     */
    public function getMethodNameFromCode()
    {
        $method_array = explode('_', $this->code);
        return $this->code == constant("GINGER_BANK_PREFIX") ? null : end($method_array);
    }

    /**
     * Retrieve payment method details, basically issuer_id for iDeal.
     * @return string[]|null
     */

    public function getPaymentDetails()
    {
        switch ($this->getMethodNameFromCode()) {
            case 'ideal' :
                return [
                    'issuer_id' => (string)$this->getIssuerId()
                ];
            default :
                return null;
        }
    }

    /**
     * Return additional_adress
     *
     * @param $order
     * @return array
     */
    public static function getAdditionalAddress($order): array
    {
        return [array_filter([
            'address_type' => 'billing',
            'address' => trim($order->billing['street_address'])
                . ' ' . trim($order->billing['suburb'])
                . ' ' . trim($order->billing['postcode'])
                . ' ' . trim($order->billing['city']),
            'country' => $order->billing['country']['iso_code_2']])];
    }

    /**
     * @param $order
     * @return array
     */
    protected function getAdditionalCustomerInfo(): array
    {
        return [
            'gender' => $this->getCustomPaymentField($this->code . '_gender'),
            'birthdate' => $this->getCustomPaymentField($this->code . '_dob'),
        ];
    }

    /**
     * Default function to get ginger order id from order comment
     *
     * @return mixed
     */
    public function getOrderIdFromHistory($oID)
    {
        return $this->searchHistoryForOrderKey($this->getOrderHistory($oID));
    }
}