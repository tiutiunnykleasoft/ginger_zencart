<?php

class GingerClient extends base
{
    public static function getClient()
    {
        $apiKey = gingerGateway::getApiKey();
        return is_null($apiKey) ? null : Ginger\Ginger::createClient(
            constant("GINGER_BANK_ENDPOINT"),
            $apiKey,
            constant("MODULE_PAYMENT_" . strtoupper(constant("GINGER_BANK_PREFIX")) . "_BUNDLE_CA") == 'True' ?
                [
                    CURLOPT_CAINFO => gingerGateway::getCaCertPath()
                ] : []
        );
    }

    /**
     * Run the capturing process for gigner order where it could be accepted.
     *
     * @param string $gingerOrderId
     */
    public function captureOrder(string $gingerOrderId)
    {
        global $messageStack;
        try {
            $ginger_order = $this->ginger->getOrder($gingerOrderId);
            $transaction = current($ginger_order['transactions']);

            if (!$transaction['is_capturable']) {
                throw new Exception(
                    'This order couldn\'t be captured'
                );
            }
            $this->ginger->captureOrderTransaction($ginger_order['id'], $transaction['id']);
            $messageStack->add_session(constant("GINGER_BANK_PREFIX") . " : Order has captured successfully!", 'success');
        } catch (Exception $exception) {
            $messageStack->add_session($exception->getMessage(), 'error');
        }
    }

    /**
     * Get Ideal Issuers and create a html dropdown.
     *
     * @return array|null
     */
    public function getIdealFields()
    {
        global $messageStack;

        try {
            $gingerIssuers = $this->ginger->getIdealIssuers();
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            return null;
        }

        $issuers = [];
        array_push($issuers, [
            'id' => '',
            'text' => 'Not selected'
        ]);
        foreach ($gingerIssuers as $issuer) {
            array_push($issuers, [
                'id' => $issuer['id'],
                'text' => $issuer['name']
            ]);
        }

        return [
            "title" => constant("MODULE_PAYMENT_" . strtoupper($this->code) . "_ISSUER_SELECT"),
            'field' => zen_draw_pull_down_menu('issuer_id', $issuers)
        ];
    }
}