<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Giropay payment method
 */
class ginger_giropay extends gingerPaymentDefault
{
    public $code = 'giropay';
}
