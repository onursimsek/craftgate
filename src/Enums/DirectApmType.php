<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum DirectApmType: string
{
    case FundTransfer = 'FUND_TRANSFER';
    case CashOnDelivery = 'CASH_ON_DELIVERY';
}
