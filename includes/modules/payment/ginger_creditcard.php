<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Credit Card payment method
 */
class ginger_creditcard extends gingerPaymentDefault
{
    public $code = 'creditcard';
}
