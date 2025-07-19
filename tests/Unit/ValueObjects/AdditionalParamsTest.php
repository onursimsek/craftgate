<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use OnurSimsek\Craftgate\ValueObjects\Components\AdditionalParams;

class AdditionalParamsTest extends ValueObjectTestCase
{
    public static function provider(): array
    {
        return [
            [AdditionalParams::class, ['msisdn' => 'foo']],
        ];
    }

    public static function rawArrayProvider(): array
    {
        return self::provider();
    }
}
