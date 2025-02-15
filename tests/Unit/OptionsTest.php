<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit;

use OnurSimsek\Craftgate\Options;
use OnurSimsek\Craftgate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class OptionsTest extends TestCase
{
    #[Test]
    public function it_should_return_with_default_values()
    {
        $options = new Options('api-key', 'secret-key');

        $this->assertEquals('api-key', $options->getApiKey());
        $this->assertEquals('secret-key', $options->getSecretKey());
        $this->assertEquals('https://api.craftgate.io', $options->getBaseUrl());
        $this->assertEquals('tr', $options->getLanguage());
        $this->assertEquals('https://api.craftgate.io', $options->getUri());

        $this->assertEquals(
            expected: ['apiKey' => 'api-key', 'secretKey' => 'secret-key', 'baseUrl' => 'https://api.craftgate.io', 'language' => 'tr'],
            actual: $options->toArray()
        );
    }

    #[Test]
    public function it_should_generate_from_array()
    {
        $options = Options::fromArray(['apiKey' => 'api-key', 'secretKey' => 'secret-key', 'baseUrl' => 'https://sandbox-api.craftgate.io', 'language' => 'en']);

        $this->assertEquals('api-key', $options->getApiKey());
        $this->assertEquals('secret-key', $options->getSecretKey());
        $this->assertEquals('https://sandbox-api.craftgate.io', $options->getBaseUrl());
        $this->assertEquals('en', $options->getLanguage());
        $this->assertEquals('https://sandbox-api.craftgate.io', $options->getUri());

        $this->assertEquals(
            expected: ['apiKey' => 'api-key', 'secretKey' => 'secret-key', 'baseUrl' => 'https://sandbox-api.craftgate.io', 'language' => 'en'],
            actual: $options->toArray()
        );
    }
}
