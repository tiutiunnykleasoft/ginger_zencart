<?php

class GingerRefund extends GingerOrder
{
    /**
     * Collect all required data for ginger refund order.
     *
     * @return array;
     */
    public function getInfoForRefundOrder($order)
    {
        $refundData = $this->getInfoForGingerOrder($order);
        $refundData['amount'] = $this->getRefundAmount($order->info);
        return $refundData;
    }

    /**
     * Validate refund input data.
     *
     * @return bool;
     */
    public function refundInputDataValidate($prefix, $amount, $gingerOrderId, $messageStack, $order_info)
    {
        if (empty($gingerOrderId)) {
            $messageStack->add_session(constant(MODULE_PAYMENT_ .$prefix. _TEXT_REFUND_ID_ERROR), 'error');
            return false;
        }

        if (!isset($amount) || $amount == 0 || $amount > $this->culc_amount($order_info)) {
            $messageStack->add_session(constant(MODULE_PAYMENT_ .$prefix. _TEXT_INVALID_REFUND_AMOUNT), 'error');
            return false;
        }

        return true;
    }

    /**
     * Get amount for refund order partially or in total
     *
     * @return int
     */
    public function getRefundAmount($order_info)
    {
        if (isset($_POST['refradioamount']) && $_POST['refradioamount'] == 'partially') {
            $amount = preg_replace('/[^0-9.,]/', '', $_POST['refamount']);
        } else {
            $amount = $this->refundGetMaxAmount($order_info['order_id'], $this->culc_amount($order_info));
        }
        return $this->getAmountInCents($amount);
    }


    /**
     * Default function of build for create refund money order.
     *
     * @return string;
     */
    public function getRefundForm($total, $prefix)
    {
        require(DIR_FS_CATALOG . 'includes/functions/showAmountField.html');

        $outputRefund = '<table style="border: 1px solid black; margin: 0;" class="noprint">';
        $outputRefund .= '<tr style="background-color: #439643;">';
        $outputRefund .= '<td style="text-align: center; color: white" class="main" >' . constant(MODULE_PAYMENT_ . $prefix . _REFUND_TITLE) . '</td></tr></br></br>';
        $outputRefund .= '<tr><td style="padding-left: 5px">' . zen_draw_form('emspay_refund', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doRefund', 'post', '', true);
        $outputRefund .= zen_draw_radio_field('refradioamount', 'total', false, '', 'checked onclick="showAmountField(this)"') . ' ' . constant(MODULE_PAYMENT_ . $prefix . _REFUND_TOTAL_TEXT) . '</br>';
        $outputRefund .= zen_draw_radio_field('refradioamount', 'partially', false, '', 'id="partially" onclick="showAmountField(this)"') . ' ' . constant(MODULE_PAYMENT_ . $prefix . _REFUND_PARTIALLY_TEXT) . '</br>';
        $outputRefund .= '<span id="amountField" style="display:none">'.constant(MODULE_PAYMENT_ . $prefix . _ENTRY_REFUND_AMOUNT_TEXT) . ' ' .zen_draw_input_field('refamount', '', ' length="10" placeholder="Max: '.$total * 0.01.' EUR" style="width: 41.7%"') . '</span>';
        $outputRefund .= '</br>' . constant(MODULE_PAYMENT_ . $prefix . _ENTRY_REFUND_TEXT_COMMENTS) . '</br>' . zen_draw_textarea_field('refnote', 'soft', '50', '3', constant(MODULE_PAYMENT_ . $prefix . _ENTRY_REFUND_DEFAULT_MESSAGE), 'style="width: 99%"') . '</br>';
        $outputRefund .= zen_draw_checkbox_field('refconfirm', '', false, '', 'required') . constant(MODULE_PAYMENT_ . $prefix . _TEXT_REFUND_CONFIRM_CHECK) . '</br>';
        $outputRefund .= '</td></tr><tr><td style="text-align: center; padding-bottom: 10px;"><input style="background-color: #439643; color: white; border: 0px solid; height: 20px; width: 90%" type="submit" name="buttonrefund" value="' . constant(MODULE_PAYMENT_ . $prefix . _ENTRY_REFUND_BUTTON_TEXT) . '">';
        $outputRefund .= '</form>';
        $outputRefund .= '</td></tr></table>';

        return $outputRefund;
    }

    /**
     * Validation, show form only if order could be refunded.
     *
     * @return string;
     */
    public function refundValidate($order, $prefix)
    {
        $ginger = GingerClient::getClient();
        
        try {
            $gingerOrder = $ginger->getOrder($this->getOrderIdFromHistory($order->info['order_id']));
        } catch (\Exception $e) {
            return MODULE_PAYMENT_.$prefix._REFUND_NOT_ALLOW_TEXT;
        }

        if ($gingerOrder['status'] !== 'completed') {
            return MODULE_PAYMENT_.$prefix._REFUND_NOT_ALLOW_TEXT;
        }

        if ($this->getRefundAmount($order->info) <= 0) {
            return MODULE_PAYMENT_.$prefix._REFUND_ALREADY_COMPLETED_TEXT;
        }
        return true;
    }

    /**
     * Get max allow amount for refund order.
     *
     * @return float;
     */
    public function refundGetMaxAmount($oID, $total)
    {
        if ($gingerOrderId = $this->getOrderIdFromHistory($oID)) {
            $order = (self::getClient())->getOrder($gingerOrderId);
        }
        return (isset($order['refunded_amount']) ? $total - $order['refunded_amount'] : $total) * 0.01;
    }
}