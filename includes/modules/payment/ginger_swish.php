<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Swish payment method
 */
class ginger_swish extends gingerPaymentDefault
{
    public $code = 'swish';
}
