<?php
$prefix = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$prefix.'_TEXT_TITLE', "Ginger Tooling");
define('MODULE_PAYMENT_'.$prefix.'_TEXT_DESCRIPTION', "The official Ginger Tooling ZenCart plugin.");

define('MODULE_PAYMENT_'.$prefix.'_STATUS_TEXT', "Enable Ginger Tooling module.");
define('MODULE_PAYMENT_'.$prefix.'_STATUS_DESCRIPTION', "Do you want to enable Ginger Tooling ZenCart Module?");

define('MODULE_PAYMENT_'.$prefix.'_API_KEY_TEXT', "Ginger Tooling API Key");
define('MODULE_PAYMENT_'.$prefix.'_API_KEY_DESCRIPTION', "Please enter your Ginger Tooling API key from merchant portal.");

define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_TEXT', "Use cURL CA bundle");
define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_DESCRIPTION', "Resolves issue when curl.cacert path is not set in PHP.ini");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_TEXT', "Status for a completed order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_DESCRIPTION', "Select the status from the list that you wish to map to the completed orders.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_TEXT', "Status for a pending orders.");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_DESCRIPTION', "Select the status from the list that you wish to map to the pending orders.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_TEXT', "Status for an error order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_DESCRIPTION', "Select the status from the list that you wish to map to the orders when they have an error.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_TEXT', "Status for an order being processed");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_DESCRIPTION', "Select the status from the list that you wish to map to the orders being processed.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_TEXT', "Status for a cancelled order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_DESCRIPTION', "Select the status from the list that you wish to map to the cancelled orders.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_TEXT', "Status for a captured/shipped order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_DESCRIPTION', "Select the status from the list that you wish to map to the captured/shipped orders.");

define('MODULE_PAYMENT_'.$prefix.'_ERROR_API_KEY', "The API Key has not been set. Please enter a valid API Key.");
define('MODULE_PAYMENT_'.$prefix.'_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$prefix.'_ERROR_ALREADY_INSTALLED', "The Ginger Tooling module is already installed.");

define('MODULE_PAYMENT_'.$prefix.'_WARNING_BAD_CURRENCIES_LIST',"<br>The settings for allowed currencies  entered in not right format, this field will be ignored.");

define('MODULE_PAYMENT_'.$prefix.'_REFUND_TITLE', '<strong>Refund Transaction</strong>');

define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_CONFIRM_CHECK', ' Check this box to confirm your intent');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_AMOUNT_TEXT', 'Enter the amount to refund');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_TEXT_COMMENTS', 'Notes (will show on Order History):');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_DEFAULT_MESSAGE', 'Refunded');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_BUTTON_TEXT', 'Do Refund');

define('MODULE_PAYMENT_'.$prefix.'_TEXT_INVALID_REFUND_AMOUNT', 'Refund failed: invalid amount.');
define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_ERROR', 'Refund request failed.');
define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_ID_ERROR', 'Failed. Only paid order is supporting refund.');
define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_SUCCESS', 'Successfully refunded.');

define('MODULE_PAYMENT_'.$prefix.'_REFUND_PARTIALLY_TEXT', 'Partially refund');
define('MODULE_PAYMENT_'.$prefix.'_REFUND_TOTAL_TEXT', 'Refund full order amount');

define('MODULE_PAYMENT_'.$prefix.'_REFUND_NOT_ALLOW_TEXT', '<strong>Refund not allow.</strong>');
define('MODULE_PAYMENT_'.$prefix.'_REFUND_ALREADY_COMPLETED_TEXT', '<strong>Refund already completed.</strong>');
