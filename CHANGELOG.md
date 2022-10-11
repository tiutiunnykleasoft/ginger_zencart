# Changelog ZenCart

## 1.0.0 ##

* Initial Release

### 1.0.3 ###

* Changed library from ems-php to ginger-php
* Renamed Sofort to Klarna Pay Now
* Renamed Klarna to Klarna Pay Later
* Add American Express, Tikkie Payment Request, WeChat 

### 1.0.4 ###

* Fix Captured and shipped functionality

## 1.1.0 ##

* Reworked Bank Transfer Payment Method.
* Reworked Klarna Pay Later Payment Method
* Add redirect to payment_url for KP Later payment

## 1.2.0 ##

* Added the ability for AfterPay to be available in the selected countries.
* Fixed IP-filtering and Payment Method availability Zone method in AfterPay and KlarnaPayLater.
* Replaced locally stored ginger-php library on composer library installer.

### 1.2.1 ###

* Removed WebHook option from all payments.
* Update plugin description.

## 1.3.0 ## 

* Updated Ginger to ZenCart status mapping.
* Completed utilize duplicate code.
* Custom prefixes were added to all function/files.
* Input_filter was added to all variables from the HTTP request.
* Plugin structure changes to supporting via GPE solution.
* Plugin code has been refactored to best supporting via GPE solution.

## 1.3.1 ##

* PHPUnit tests was added to cover GPE solution workability.

## 1.3.2 ##

* Completely implemented multi-currency feature with synchronization with Ginger API.
* Implemented stub `MockedOrderBuilder.php` for PHPUnit tests.
* Implemented test coverage for createOrder function.
* Implemented Google Pay payment method.  
* Solved issue when the ginger pending message doesn't display for Afterpay payment method.
* Solved issue when Afterpay payment method doesn't work properly.
* Solved issue with the content of error message on returnUrl.
* Solved issue when Klarna Pay Later had missing keys in translation files.
* Solved issue when Klarna Pay Later doesn't install.
* Solved issue UpdateOrderStatus function for payment methods with order lines.
* Solved issue when bad currency list warning displays on the checkout page when not expected.

## 1.3.3 ##

* Implemented a new extra array with additional environment information for the order.
* Implemented Apple Pay detection.
* Implemented Order Lines for every order.
* Implemented extra option to iDeal issuer list, with empty value.
* Updated customer array.
* Updated field, which is has been used for before capturing check.
* Solved iDeal issuer form waring message, where constant prints instead of a label.
* Solved issue when payment couldn't be switched off.
* Replaced constant version to placeholders, to replace it on GitHub actions steps according to tag version. 