<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum CardExpiryStatus: string
{
    case Expired = 'Expired';
    case WillExpireNextMonth = 'Will_EXPIRE_NEXT_MONTH';
    case NotExpired = 'NOT_EXPIRED';
}
