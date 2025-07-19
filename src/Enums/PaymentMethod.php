<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum PaymentMethod: string
{
    case Card = 'CARD';
    case Masterpass = 'MASTERPASS';
    case Papara = 'PAPARA';
    case Payoneer = 'PAYONEER';
    case Pluxee = 'PLUXEE';
    case Edenred = 'EDENRED';
    case EdenredGift = 'EDENRED_GIFT';
    case Alipay = 'ALIPAY';
    case Klarna = 'KLARNA';
    case Afterpay = 'AFTERPAY';
    case Applepay = 'APPLEPAY';
    case Googlepay = 'GOOGLEPAY';
    case Paypal = 'PAYPAL';
    case InstantTransfer = 'INSTANT_TRANSFER';
    case Stripe = 'STRIPE';
    case Hepsipay = 'HEPSIPAY';
    case GarantiPay = 'GARANTI_PAY';
    case Juzdan = 'JUZDAN';
    case Multinet = 'MULTINET';
    case MultinetGift = 'MULTINET_GIFT';
    case Metropol = 'METROPOL';
    case Ispay = 'ISPAY';
    case YkbWorldPay = 'YKB_WORLD_PAY';
    case YkbWorldPayShoppingLoan = 'YKB_WORLD_PAY_SHOPPING_LOAN';
}
