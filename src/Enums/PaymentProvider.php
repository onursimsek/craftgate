<?php

namespace OnurSimsek\Craftgate\Enums;

enum PaymentProvider: string
{
    case GarantiPay = 'GARANTI_PAY';
    case WorldPay = 'YKB_WORLD_PAY';
    case WorldPayShoppingLoan = 'YKB_WORLD_PAY_SHOPPING_LOAN';
}
