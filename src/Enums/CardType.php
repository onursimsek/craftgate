<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum CardType: string
{
    case CreditCard = 'CREDIT_CARD';
    case DebitCard = 'DEBIT_CARD';
    case PrepaidCard = 'PREPAID_CARD';
}
