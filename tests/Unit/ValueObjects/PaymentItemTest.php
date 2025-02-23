<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use OnurSimsek\Craftgate\Util;
use OnurSimsek\Craftgate\ValueObjects\PaymentItem;

class PaymentItemTest extends ValueObjectTestCase
{
    public static function provider(): array
    {
        return [
            [
                PaymentItem::class,
                [
                    'price' => 100,
                    'name' => 'Item 01',
                    'externalId' => Util::guid(),
                    'subMerchantMemberId' => random_int(1000, 5000),
                    'subMerchantMemberPrice' => 50,
                ],
            ],
            [
                PaymentItem::class,
                [
                    'price' => 100.50,
                    'name' => null,
                    'externalId' => null,
                    'subMerchantMemberId' => null,
                    'subMerchantMemberPrice' => null,
                ],
            ],
        ];
    }
}
