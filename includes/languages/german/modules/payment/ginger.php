<?php
$prefix = strtoupper(explode('.php',basename(__FILE__))[0]);
define('MODULE_PAYMENT_' . $prefix . '_STATUS', "False");
define('MODULE_PAYMENT_' . $prefix . '_SORT_ORDER', 1);

define('MODULE_PAYMENT_'.$prefix.'_TEXT_TITLE', "Ginger Tooling");
define('MODULE_PAYMENT_'.$prefix.'_TEXT_DESCRIPTION', "Offizielle Ginger Tooling ZenCart-Plugin");

define('MODULE_PAYMENT_'.$prefix.'_STATUS_TEXT', "Aktivieren Ginger Tooling-Modul");
define('MODULE_PAYMENT_'.$prefix.'_STATUS_DESCRIPTION', "Wollen Sie Ginger Tooling ZenCart Modul aktivieren?");

define('MODULE_PAYMENT_'.$prefix.'_API_KEY_TEXT', "API Schlüssel");
define('MODULE_PAYMENT_'.$prefix.'_API_KEY_DESCRIPTION', "Duplizieren Sie Ihre Ginger Tooling API Schlüssel von Merchant Portal.");

define('MODULE_PAYMENT_DUCT_TEXT', "Ginger Tooling Produkt");
define('MODULE_PAYMENT_DUCT_DESCRIPTION', "Wählen Sie Ihres Ginger Tooling Produkt.");

define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_TEXT', "cURL CA bündel benutzen");
define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_DESCRIPTION', "Löst Probleme, wenn curl.cacert Pfad nicht in PHP.ini eingestellt wird.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_TEXT', "Status für eine abgeschlossene Bestellung");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_DESCRIPTION', "Wählen Sie den Status aus der Liste der Sie anwenden möchten für abgeschlossene Bestellungen.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_TEXT', "Status für eine ausstehende Bestellung");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_DESCRIPTION', "Wählen Sie den Status aus der Liste der Sie anwenden möchten für ausstehende Bestellungen.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_TEXT', "Status für eine fehlgeschlagen Bestellung");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_DESCRIPTION', "Wählen Sie den Status der Sie anwenden möchten für fehlgeschlagen Bestellungen.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_TEXT', "Status für eine Bestellung in Verarbeitung");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_DESCRIPTION', "Wählen Sie den Status der Sie anwenden möchten für Bestellungen die verarbeitet werden.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_TEXT', "Status für eine annullierte Bestellung");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_DESCRIPTION', "Wählen Sie den Status aus der Liste der Sie anwenden möchten für annulierte Bestellungen.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_TEXT', "Status für eine erfasste/ausgelieferte Bestellung");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_DESCRIPTION', "Wählen Sie den Status der Sie anwenden möchten für erfasste/ausgelieferte Bestellungen.");

define('MODULE_PAYMENT_'.$prefix.'_ERROR_API_KEY', "Der API-Schlüssel wurde nicht festgelegt. Bitte geben Sie einen gültigen API-Schlüssel ein.");
define('MODULE_PAYMENT_'.$prefix.'_ERROR_TRANSACTION', "Leider ist ein Fehler bei der Verarbeitung Ihrer Bezahlung aufgetreten. Bitte versuchen Sie nochmals.");

define('MODULE_PAYMENT_'.$prefix.'_WARNING_BAD_CURRENCIES_LIST',"<br>Die Einstellungen für zulässige Währungen werden im nicht richtigen Format eingegeben. Dieses Feld wird ignoriert.");

define('MODULE_PAYMENT_'.$prefix.'_REFUND_TITLE', '<strong>Rückerstattung Transaktion</strong>');

define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_CONFIRM_CHECK', ' Aktion bestätigen');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_AMOUNT_TEXT', 'Geben Sie den Betrag ein');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_TEXT_COMMENTS', 'Notizen (werden im Bestellverlauf angezeigt):');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_DEFAULT_MESSAGE', 'Rückerstatten');
define('MODULE_PAYMENT_'.$prefix.'_ENTRY_REFUND_BUTTON_TEXT', 'Machen Sie eine Rückerstattung');

define('MODULE_PAYMENT_'.$prefix.'_TEXT_INVALID_REFUND_AMOUNT', 'Rückerstattung fehlgeschlagen: Ungültiger Betrag.');
define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_ERROR', 'Rückerstattung Anforderung fehlgeschlagen.');
define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_ID_ERROR', 'Gescheitert. Nur die bezahlte Bestellung unterstützt die Rückerstattung.');
define('MODULE_PAYMENT_'.$prefix.'_TEXT_REFUND_SUCCESS', 'Erfolgreich erstattet.');

define('MODULE_PAYMENT_'.$prefix.'_REFUND_PARTIALLY_TEXT', 'Teilweise erstatten');
define('MODULE_PAYMENT_'.$prefix.'_REFUND_TOTAL_TEXT', 'Vollständigen Bestellbetrag zurückerstatten');

define('MODULE_PAYMENT_'.$prefix.'_REFUND_NOT_ALLOW_TEXT', '<strong>Rückerstattung nicht erlaubt.</strong>');
define('MODULE_PAYMENT_'.$prefix.'_REFUND_ALREADY_COMPLETED_TEXT', '<strong>Rückerstattung bereits abgeschlossen.</strong>');
