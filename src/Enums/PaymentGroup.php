<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum PaymentGroup: string
{
    case PRODUCT = 'PRODUCT';
    case LISTING_OR_SUBSCRIPTION = 'LISTING_OR_SUBSCRIPTION';
}
