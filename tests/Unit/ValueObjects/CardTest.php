<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use OnurSimsek\Craftgate\ValueObjects\Card;

class CardTest extends ValueObjectTestCase
{
    public static function provider(): array
    {
        return [
            [
                Card::class,
                [
                    'cardHolderName' => 'Onur Simsek',
                    'cardNumber' => '1234123412341234',
                    'expireYear' => '2085',
                    'expireMonth' => '01',
                    'cvc' => '015',
                    'storeCardAfterSuccessPayment' => true,
                    'cardAlias' => 'card-alias',
                    'cardUserKey' => 'card-user-key',
                    'cardToken' => 'card-token',
                    'loyalty' => null,
                ],
            ],
            [
                Card::class,
                [
                    'cardHolderName' => 'Onur Simsek',
                    'cardNumber' => '1234123412341234',
                    'expireYear' => '2085',
                    'expireMonth' => '01',
                    'cvc' => '015',
                ],
                [
                    'storeCardAfterSuccessPayment' => false,
                    'cardAlias' => null,
                    'cardUserKey' => null,
                    'cardToken' => null,
                    'loyalty' => null,
                ],
            ],
        ];
    }
}
