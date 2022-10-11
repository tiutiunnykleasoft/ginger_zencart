<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Google Pay payment method
 */
class ginger_googlepay extends gingerPaymentDefault
{
    public $code = 'googlepay';
}
