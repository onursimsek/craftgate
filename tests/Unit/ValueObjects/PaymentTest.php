<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\Enums\PaymentPhase;
use OnurSimsek\Craftgate\Util;
use OnurSimsek\Craftgate\ValueObjects\AdditionalParams;
use OnurSimsek\Craftgate\ValueObjects\Card;
use OnurSimsek\Craftgate\ValueObjects\FraudCheck;
use OnurSimsek\Craftgate\ValueObjects\Payment;
use OnurSimsek\Craftgate\ValueObjects\PaymentItem;

class PaymentTest extends ValueObjectTestCase
{
    public static function provider(): array
    {
        return [
            [
                Payment::class,
                [
                    'price' => 100,
                    'paidPrice' => 100,
                    'items' => [
                        parent::mock(PaymentItem::class),
                    ],
                    'currency' => Currency::EUR,
                    'installment' => 4,
                    'walletPrice' => 10,
                    'paymentGroup' => PaymentGroup::Product,
                    'conversationId' => Util::guid(),
                    'card' => parent::mock(Card::class),
                    'buyerMemberId' => random_int(1000, 9999),
                    'externalId' => Util::guid(),
                    'paymentPhase' => PaymentPhase::PreAuth,
                    'paymentChannel' => 'web',
                    'bankOrderId' => Util::guid(),
                    'clientIp' => '127.0.0.1',
                    'posAlias' => 'isbank',
                    'retry' => true,
                    'fraudParams' => parent::mock(FraudCheck::class),
                    'additionalParams' => parent::mock(AdditionalParams::class),
                ],
            ],
            [
                Payment::class,
                [
                    'price' => 100,
                    'paidPrice' => 100,
                    'items' => [],
                ],
                [
                    'currency' => Currency::TL,
                    'installment' => 1,
                    'walletPrice' => 0,
                    'paymentGroup' => null,
                    'conversationId' => null,
                    'card' => null,
                    'buyerMemberId' => null,
                    'externalId' => null,
                    'paymentPhase' => null,
                    'paymentChannel' => null,
                    'bankOrderId' => null,
                    'clientIp' => null,
                    'posAlias' => null,
                    'retry' => true,
                    'fraudParams' => null,
                    'additionalParams' => null,
                ],
            ],
        ];
    }
}
