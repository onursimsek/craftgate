<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum LoyaltyType: string
{
    case RewardMoney = 'REWARD_MONEY';
    case AdditionalInstallment = 'ADDITIONAL_INSTALLMENT';
    case PostponingInstallment = 'POSTPONING_INSTALLMENT';
    case ExtraPoints = 'EXTRA_POINTS';
    case GainingMinutes = 'GAINING_MINUTES';
    case PostponingStatement = 'POSTPONING_STATEMENT';
}
