<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Sofort payment method
 */
class ginger_sofort extends gingerPaymentDefault
{
    public $code = 'sofort';
}
