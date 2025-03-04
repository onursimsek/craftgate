<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum PaymentGroup: string
{
    case Product = 'PRODUCT';
    case ListingOrSubscription = 'LISTING_OR_SUBSCRIPTION';
}
