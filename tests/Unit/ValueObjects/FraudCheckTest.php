<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use OnurSimsek\Craftgate\Util;
use OnurSimsek\Craftgate\ValueObjects\FraudCheck;

class FraudCheckTest extends ValueObjectTestCase
{
    public static function provider(): array
    {
        return [
            [
                FraudCheck::class,
                [
                    'buyerExternalId' => Util::guid(),
                    'buyerPhoneNumber' => '5055055050',
                    'buyerEmail' => 'foo@bar.baz',
                    'customerFraudVariable' => 'foo',
                ],
            ],
        ];
    }

    public static function rawArrayProvider(): array
    {
        return self::provider();
    }
}
