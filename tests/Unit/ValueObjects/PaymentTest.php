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
                    'price' => 100.0,
                    'paidPrice' => 100.0,
                    'items' => [
                        parent::mock(PaymentItem::class),
                    ],
                    'currency' => Currency::EUR,
                    'installment' => 4,
                    'walletPrice' => 10.0,
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
                [
                    'items' => [],
                ],
            ],
            [
                Payment::class,
                [
                    'price' => 100.0,
                    'paidPrice' => 100.0,
                    'items' => [],
                ],
                [
                    'currency' => 'TRY',
                    'installment' => 1,
                    'walletPrice' => 0.0,
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

    public static function rawArrayProvider(): array
    {
        return [
            [
                Payment::class,
                [
                    'price' => 100.50,
                    'paidPrice' => 100.50,
                    'walletPrice' => 0.0,
                    'installment' => 1,
                    'currency' => Currency::TL,
                    'paymentGroup' => PaymentGroup::ListingOrSubscription,
                    'conversationId' => Util::guid(),
                    'card' => [
                        'cardHolderName' => 'John Doe',
                        'cardNumber' => '5258640000000001',
                        'expireYear' => '2085',
                        'expireMonth' => '01',
                        'cvc' => '015',
                    ],
                    'items' => [
                        [
                            'externalId' => Util::guid(),
                            'name' => 'Item 1',
                            'price' => 30.10,
                        ],
                        [
                            'externalId' => Util::guid(),
                            'name' => 'Item 2',
                            'price' => 50.20,
                        ],
                        [
                            'externalId' => Util::guid(),
                            'name' => 'Item 3',
                            'price' => 20.20,
                        ],
                    ],
                ],
                [
                    'currency' => 'TRY',
                    'paymentGroup' => 'LISTING_OR_SUBSCRIPTION',
                    'card' => [
                        'storeCardAfterSuccessPayment' => false,
                        'cardAlias' => null,
                        'cardUserKey' => null,
                        'cardToken' => null,
                        'loyalty' => null,
                    ],
                    'items' => [
                        [
                            'subMerchantMemberId' => null,
                            'subMerchantMemberPrice' => null,
                        ],
                        [
                            'subMerchantMemberId' => null,
                            'subMerchantMemberPrice' => null,
                        ],
                        [
                            'subMerchantMemberId' => null,
                            'subMerchantMemberPrice' => null,
                        ],
                    ],
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
            ]
        ];
    }
}
