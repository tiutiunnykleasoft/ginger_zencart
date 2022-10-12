<?php
$prefix = strtoupper(explode('.php', basename(__FILE__))[0]);
define('MODULE_PAYMENT_' . $prefix . '_STATUS', "True");
define('MODULE_PAYMENT_' . $prefix . '_SORT_ORDER', 1);

define('MODULE_PAYMENT_' . $prefix . '_TEXT_TITLE', "Ginger Tooling");
define('MODULE_PAYMENT_' . $prefix . '_TEXT_DESCRIPTION', "Het Ginger Tooling official ZenCart plugin.");

define('MODULE_PAYMENT_' . $prefix . '_STATUS_TEXT', "Schakel Ginger Tooling-module in");
define('MODULE_PAYMENT_' . $prefix . '_STATUS_DESCRIPTION', "Wilt u Ginger Tooling ZenCart-module inschakelen?");

define('MODULE_PAYMENT_' . $prefix . '_API_KEY_TEXT', "API Key");
define('MODULE_PAYMENT_' . $prefix . '_API_KEY_DESCRIPTION', "Kopieer uw Ginger Tooling API key van uw merchant portal.");

define('MODULE_PAYMENT_DUCT_TEXT', "Ginger Tooling Product");
define('MODULE_PAYMENT_DUCT_DESCRIPTION', "Selecteer uw Ginger Tooling product.");

define('MODULE_PAYMENT_' . $prefix . '_BUNDLE_CA_TEXT', "Gebruik cURL CA bundel");
define('MODULE_PAYMENT_' . $prefix . '_BUNDLE_CA_DESCRIPTION', "Voorkomt probleem indien curl.cacert niet ingesteld is in PHP.ini .");

define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_COMPLETED_TEXT', "Status voor voltooide bestellingen");
define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_COMPLETED_DESCRIPTION', "Selecteer de status u wilt gebruiken voor voltooide bestellingen.");

define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_PENDING_TEXT', "Status voor een lopende bestelling");
define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_PENDING_DESCRIPTION', "Selecteer de status u wilt gebruiken voor lopende bestellingen.");

define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_ERROR_TEXT', "Status voor bestellingen met een fout");
define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_ERROR_DESCRIPTION', "Selecteer de status die u wilt gebruiken voor bestellingen waarbij een fout is opgetreden.");

define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_PROCESSING_TEXT', "Status voor bestellingen in behandeling");
define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_PROCESSING_DESCRIPTION', "Selecteer de status die u wilt gebruiken voor bestellingen in behandeling.");

define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_CANCELLED_TEXT', "Status voor geannuleerde bestellingen");
define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_CANCELLED_DESCRIPTION', "Selecteer de status die u wilt gebruiken voor geannuleerde bestellingen.");

define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_SHIPPED_TEXT', "Status voor een captured / verzonden bestelling");
define('MODULE_PAYMENT_' . $prefix . '_ORDER_STATUS_SHIPPED_DESCRIPTION', "Selecteer de status die u wilt gebruiken voor captured / verzonden bestellingen.");

define('MODULE_PAYMENT_' . $prefix . '_ERROR_API_KEY', "De API-sleutel is niet ingesteld. Voer een geldige API-sleutel in.");
define('MODULE_PAYMENT_' . $prefix . '_ERROR_TRANSACTION', "Helaas is er een fout opgetreden tijdens het verwerken van uw betaling. Probeer het alstublieft nogmaals.");

define('MODULE_PAYMENT_' . $prefix . '_WARNING_BAD_CURRENCIES_LIST', "<br>De instellingen voor toegestane valuta's zijn in een onjuist formaat ingevoerd, dit veld wordt genegeerd.");
