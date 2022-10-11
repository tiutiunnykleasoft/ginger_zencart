<?php
$prefix = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$prefix.'_TEXT_TITLE', "Ginger Tooling");
define('MODULE_PAYMENT_'.$prefix.'_TEXT_DESCRIPTION', "Le plug-in officiel ZenCart du Ginger Tooling");

define('MODULE_PAYMENT_'.$prefix.'_STATUS_TEXT', "Activer le module Ginger Tooling");
define('MODULE_PAYMENT_'.$prefix.'_STATUS_DESCRIPTION', "Voulez-vous activer le Ginger Tooling ZenCart Module?");

define('MODULE_PAYMENT_'.$prefix.'_API_KEY_TEXT', "Clé API");
define('MODULE_PAYMENT_'.$prefix.'_API_KEY_DESCRIPTION', "Obtenez votre Ginger Tooling clé API du portail marchand.");

define('MODULE_PAYMENT_DUCT_TEXT', "Ginger Tooling Produit");
define('MODULE_PAYMENT_DUCT_DESCRIPTION', "Sélectionnez le produit Ginger Tooling que vous utilisez.");

define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_TEXT', "Utilisez bundle cURL CA");
define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_DESCRIPTION', "Si activé, résout le problème lorsque le curl.cacert path n\'est pas défini dans PHP.ini .");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_TEXT', "Statut pour une commande réalisé");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_DESCRIPTION', "Sélectionnez le statut de la liste que vous souhaitez mapper aux commandes réalisées.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_TEXT', "Statut pour une commande en attente");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_DESCRIPTION', "Sélectionnez le statut de la liste que vous souhaitez mapper aux commandes en attente.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_TEXT', "Statut pour une commande avec erreur");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_DESCRIPTION', "Sélectionnez l'état de la liste que vous souhaitez mapper les commandes quand ils ont une erreur.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_TEXT', "Statut pour commande en cours de traitement");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_DESCRIPTION', "Sélectionnez le statut de la liste que vous souhaitez mapper aux commandes en cours de traitement.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_TEXT', "Statut pour commande Annulé");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_DESCRIPTION', "Sélectionnez le statut de la liste que vous souhaitez mapper aux commandes annulées.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_TEXT', "Statut pour une commande capturée / expédiée");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_DESCRIPTION', "Sélectionnez le statut de la liste que vous souhaitez mapper aux commandes capturées / expédiées.");

define('MODULE_PAYMENT_'.$prefix.'_ERROR_API_KEY', "La clé API n'a pas été définie. Veuillez entrer une clé d'API valide.");
define('MODULE_PAYMENT_'.$prefix.'_ERROR_TRANSACTION', "Il y avait malheureusement un problème traitant votre paiement. Veuillez reessayer le paiement s'il vous plaît.");

define('MODULE_PAYMENT_'.$prefix.'_WARNING_BAD_CURRENCIES_LIST',"<br>Les paramètres pour les devises autorisées saisies dans un format incorrect, ce champ sera ignoré.");
