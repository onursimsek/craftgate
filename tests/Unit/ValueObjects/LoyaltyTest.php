<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use OnurSimsek\Craftgate\Enums\LoyaltyType;
use OnurSimsek\Craftgate\ValueObjects\Loyalty;
use OnurSimsek\Craftgate\ValueObjects\Reward;

class LoyaltyTest extends ValueObjectTestCase
{
    public static function provider(): array
    {
        return [
            [
                Loyalty::class,
                [
                    'type' => LoyaltyType::RewardMoney,
                    'reward' => null,
                ],
            ],
            [
                Loyalty::class,
                [
                    'type' => LoyaltyType::ExtraPoints,
                    'reward' => parent::mock(Reward::class),
                ],
            ],
        ];
    }
}
