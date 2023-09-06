<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Klarna Direct Debit payment method
 */
class ginger_klarnadirectdebit extends gingerPaymentDefault
{
    public $code = 'klarnadirectdebit';
}
