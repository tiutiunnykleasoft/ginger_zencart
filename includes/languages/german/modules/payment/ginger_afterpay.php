<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);
define('MODULE_PAYMENT_'.$method_name.'_STATUS', "True");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER', 1);
define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Ihre Bestellung %s bei %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Zahlungsmethode von Ginger Tooling");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Zahlungsmethode Anzeigename");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Name der Zahlungsmethode, die dem Kunden angezeigt wird.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Aktivieren AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wollen Sie die AfterPay aktivieren?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sortierreihenfolge für AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "Die Zahlungsmethode mit der niedrigsten Reihenfolge wird zuerst angezeigt.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone für die Verfügbarkeit der Zahlungsmethode");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Wenn eine Zone ausgewählt ist, ist diese Zahlungsmethode nur für diese Zone aktiviert.");

define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_TEXT', "Test API Schlüssel");
define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_DESCRIPTION', "Bitte geben Sie die API-Schlüssel von der Test Web-Shop für Prüfung AfterPay ein. Dies gilt nur wenn Sie AfterPay offerieren.");

define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_TEXT', "IP-Adresse(n) für Prüfung AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_DESCRIPTION', "Sie können spezifische IP-adresse(n) für AfterPay eingeben (zum Beispiel: IP addresse 128.0.0.1, 255.255.255.255). Wenn Sie nichts eingeben ist AfterPay wahrnehmbar in jeder IP-adresse.");

define('MODULE_PAYMENT_'.$method_name.'_DOB', "Bitte geben Sie ihr Geburtsdatum im folgenden Format an: JJJJ-MM-TT, Z.B. 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_GENDER', "Bitte wählen Sie Ihr Geschlecht:");
define('MODULE_PAYMENT_'.$method_name.'_MALE', "Mann");
define('MODULE_PAYMENT_'.$method_name.'_FEMALE', "Frau");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Leider ist ein Fehler bei der Verarbeitung Ihrer Bezahlung aufgetreten. Bitte versuchen Sie nochmals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "Das AfterPay-Modul ist bereits installiert.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION_IS_CANCELLED', "We are sorry to inform you that your request to pay afterwards cannot be accepted by Afterpay. This could have been caused by various (temporary) reasons. If you have any questions pertaining to your rejection, please contact the Afterpay Customer Service via link https://www.afterpay.nl/en/customers/contact or by phone via +31 20 72 30 270. We advise you to select another payment method to complete the payment of your order.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_GENDER', "Sie haben kein Geschlecht ausgewählt. Bitte wählen Sie das richtige Geschlecht.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_DOB', "Leider ist ein Fehler aufgetreten mit dem Geburtsdatum. Bitte geben Sie ihr Geburtsdatum im folgenden Format an: JJJJ-MM-TT, Z.B. 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TERMS_AND_CONDITIONS', "Bitte akzeptieren Sie die Nutzungsbedingungen");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_COUNTRY_IS_NOT_VALID', "Leider können Sie AfterPay nicht verwenden, da Afterpay nur für Adressen in den Niederlanden und Belgien verfügbar ist. Bitte verwenden Sie die richtige Adresse oder eine andere Zahlungsmethode wählen.");

define('MODULE_PAYMENT_'.$method_name.'_I_ACCEPT', "Ich akzeptiere AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_TERMS_AND_CONDITIONS', "Nutzungsbedingungen");

define('MODULE_PAYMENT_'.$method_name.'_COUNTRIES_AVAILABLE_TEXT', "Fur AfterPay verfugbare Lander");
define('MODULE_PAYMENT_'.$method_name.'_COUNTRIES_AVAILABLE_DESCRIPTION', "Damit AfterPay fur jedes andere Land verwendet werden kann, fugen Sie einfach seinen Landercode (in ISO 2-Norm) in das Feld 'Fur AfterPay verfugbare Lander' ein.<br> Beispiel: BE, NL, FR <br> Als het veld leeg is, is AfterPay beschikbaar voor alle landen.");

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Zulässige Währungen");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "Die Zahlungsmethode ist NUR für ausgewählte Währungen verfügbar. Sie können diese Liste verwalten und mit Währungen vergleichen, die von Ihrem Shop akzeptiert werden. <br> Wenn leer, werden die Shop-Währungen mit der Liste der Standardwährungen der Zahlungsanbieter verglichen. <br> Akzeptiertes Listenformat ist <i> CODE1, CODE2, CODE3 </i> Beispiel <i> USD, EUR, UAH </i>.");
