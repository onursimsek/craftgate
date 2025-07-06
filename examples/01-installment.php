<?php

declare(strict_types=1);

use OnurSimsek\Craftgate\Craftgate;

require __DIR__ . '/init.php';

/** @var Craftgate $craftgate */

// Search
$craftgate->installment()->search(100);
$craftgate->installment()->search(100, ['binNumber' => '525864']);

// Bin
$craftgate->installment()->bin('525864');

/**
 * Old method
 */
$response = $craftgate->installment()->searchInstallments([
    'binNumber' => '525864',
    'price' => 100,
    'currency' => 'TRY',
]);
// var_dump($response->getBody()->getContents());

$response = $craftgate->installment()->retrieveBinNumber('525864');
// var_dump($response->getBody()->getContents());
