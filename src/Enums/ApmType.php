<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum ApmType: string
{
    case Papara = 'PAPARA';
    case Payoneer = 'PAYONEER';
    case Pluxee = 'PLUXEE';
    case Edenred = 'EDENRED';
    case EdenredGift = 'EDENRED_GIFT';
    case Alipay = 'ALIPAY';
    case Paypal = 'PAYPAL';
    case Klarna = 'KLARNA';
    case Afterpay = 'AFTERPAY';
    case Stripe = 'STRIPE';
    case TomFinance = 'TOM_FINANCE';
    case Tompay = 'TOMPAY';
    case Alfabank = 'ALFABANK';
    case Zip = 'ZIP';
    case Haso = 'HASO';
    case Paycell = 'PAYCELL';
    case Chippin = 'CHIPPIN';
    case Multinet = 'MULTINET';
    case MultinetGift = 'MULTINET_GIFT';
    case FundTransfer = 'FUND_TRANSFER';
    case CashOnDelivery = 'CASH_ON_DELIVERY';
    case Ispay = 'ISPAY';
    case Bizum = 'BIZUM';
    case PaycellDcb = 'PAYCELL_DCB';
    case Iwallet = 'IWALLET';
    case Metropol = 'METROPOL';
    case PaylandsMbWay = 'PAYLANDS_MB_WAY';
}
