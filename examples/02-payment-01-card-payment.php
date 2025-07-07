<?php

declare(strict_types=1);

use OnurSimsek\Craftgate\Craftgate;
use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\Util;
use OnurSimsek\Craftgate\ValueObjects\Card;
use OnurSimsek\Craftgate\ValueObjects\Payment;
use OnurSimsek\Craftgate\ValueObjects\PaymentItem;

require __DIR__ . '/init.php';

/** @var Craftgate $craftgate */
$items = [
    new PaymentItem(30, 'item 1', Util::guid()),
    new PaymentItem(50, 'item 2', Util::guid()),
    new PaymentItem(20, 'item 3', Util::guid()),
];

$card = new Card('John Doe', '5258640000000001', '2085', '01', '015');

$payment = new Payment(100, 100, $items, card: $card);

$response = $craftgate->payment()->cardPayment()->create($payment);
var_dump($response->getBody()->getContents());

/**
 * Old method
 */
$params = [
    'price' => 100,
    'paidPrice' => 100,
    'walletPrice' => 0,
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
            'price' => 30,
        ],
        [
            'externalId' => Util::guid(),
            'name' => 'Item 2',
            'price' => 50,
        ],
        [
            'externalId' => Util::guid(),
            'name' => 'Item 3',
            'price' => 20,
        ],
    ],
];

$resp = $craftgate->payment()->createPayment($params);
var_dump($resp);
