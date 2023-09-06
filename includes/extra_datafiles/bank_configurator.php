<?php

/**
 * Prefix for Bank functionality.
 */
const GINGER_BANK_PREFIX = 'ginger';

/**
 *  Ginger Endpoint
 */

const GINGER_BANK_ENDPOINT = 'https://api.dev.gingerpayments.com/';

/**
 *
 */
const GINGER_DEFAULT_LANGUAGE = 'english';

/**
 * Mapping statuses from Platform to Ginger API
 */
const GINGER_PAYMENT_MAPPING = [
    'afterpay' => 'afterpay',
    'applepay' => 'apple-pay',
    'bancontact' => 'bancontact',
    'banktransfer' => 'bank-transfer',
    'creditcard' => 'credit-card',
    'ideal' => 'ideal',
    'klarnapaylater' => 'klarna-pay-later',
    'klarnapaynow' => 'klarna-pay-now',
    'payconiq' => 'payconiq',
    'paypal' => 'paypal',
    'amex' => 'amex',
    'tikkiepaymentrequest' => 'tikkie-payment-request',
    'wechat' => 'wechat',
    'googlepay' => 'google-pay',
    'viacash' => 'viacash',
    'swish' => 'swish',
    'klarnadirectdebit' => 'klarna-direct-debit',
    'sofort' => 'sofort',
    'mobilepay' => 'mobilepay',
    'giropay' => 'giropay'
];

function getBankRepoPrefix(): string
{
    return 'ginger';
}

function getGingerPluginName(): string
{
    return 'ginger-zencart';
}