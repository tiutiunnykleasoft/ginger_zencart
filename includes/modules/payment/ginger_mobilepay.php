<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for MobilePay payment method
 */
class ginger_mobilepay extends gingerPaymentDefault
{
    public $code = 'mobilepay';
}
