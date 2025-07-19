<?php

declare(strict_types=1);

use OnurSimsek\Craftgate\Craftgate;
use OnurSimsek\Craftgate\Util;
use OnurSimsek\Craftgate\ValueObjects\CheckoutPayment;
use OnurSimsek\Craftgate\ValueObjects\Components\PaymentItem;

require __DIR__ . '/init.php';

/** @var Craftgate $craftgate */
$items = [
    new PaymentItem(30, 'item 1', Util::guid()),
    new PaymentItem(50, 'item 2', Util::guid()),
    new PaymentItem(20, 'item 3', Util::guid()),
];

$payment = new CheckoutPayment(100, 100, $items, 'https://localhost/callback');

$response = $craftgate->payment()->checkoutPayment()->init($payment);
var_dump($response->getBody()->getContents());
