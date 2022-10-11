<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');

/**
 * Class for iDEAL payment method
 */
class ginger_klarnapaylater extends gingerPaymentDefault
{
    public $code = 'klarnapaylater';

    /**
     * Install function.
     *
     * @return null|string
     */
    public function install()
    {
        $sort_order = parent::install();

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _TEST_API_KEY_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _TEST_API_KEY_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_TEST_API_KEY',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _IP_FILTERING_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _IP_FILTERING_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_IP_FILTERING',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order
        ]);

        return null;
    }

    /**
     * Returns array of configurable field.
     *
     * @return array
     */
    public function keys(): array
    {
        $std_keys = parent::keys();
        return array_merge($std_keys, [
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_TEST_API_KEY',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_IP_FILTERING'
        ]);
    }

    /**
     * @return string
     */
    public function process_button()
    {
        return zen_draw_hidden_field(zen_session_name(), zen_session_id());
    }
}
