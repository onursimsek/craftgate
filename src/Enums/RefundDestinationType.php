<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum RefundDestinationType: string
{
    case Provider = 'PROVIDER';
    case Wallet = 'WALLET';
}
