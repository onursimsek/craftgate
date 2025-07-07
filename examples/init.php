<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use OnurSimsek\Craftgate\Craftgate;
use OnurSimsek\Craftgate\Options;

require 'vendor/autoload.php';

$options = new Options('api-key', 'secret-key', 'https://sandbox-api.craftgate.io');

/*$options = Options::fromArray([
    'apiKey' => 'api-key',
    'secretKey' => 'secret-key',
    'baseUrl' => 'https://sandbox-api.craftgate.io'
]);*/

$client = new Client();

$craftgate = new Craftgate($options, $client);
