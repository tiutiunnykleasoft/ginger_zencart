<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Viacash payment method
 */
class ginger_viacash extends gingerPaymentDefault
{
    public $code = 'viacash';
}
