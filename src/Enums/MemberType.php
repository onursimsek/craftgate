<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum MemberType: string
{
    case Personal = 'PERSONAL';
    case PrivateCompany = 'PRIVATE_COMPANY';
    case LimitedOrJointStockCompany = 'LIMITED_OR_JOINT_STOCK_COMPANY';
}
