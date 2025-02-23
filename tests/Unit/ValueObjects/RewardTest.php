<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use OnurSimsek\Craftgate\ValueObjects\Reward;

class RewardTest extends ValueObjectTestCase
{
    public static function provider(): array
    {
        return [
            [
                Reward::class,
                [
                    'cardRewardMoney' => 123.0,
                    'firmRewardMoney' => 12.3,
                ],
            ],
        ];
    }
}
