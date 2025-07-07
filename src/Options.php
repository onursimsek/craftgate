<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate;

use GuzzleHttp\Psr7\Uri;
use OnurSimsek\Craftgate\Contracts\Options as OptionsContract;
use Psr\Http\Message\UriInterface;

class Options implements OptionsContract
{
    private const BASE_URL = 'https://api.craftgate.io';
    private const LANGUAGE = 'tr';

    public function __construct(
        private readonly string $apiKey,
        private readonly string $secretKey,
        private readonly string $baseUrl = self::BASE_URL,
        private readonly string $language = self::LANGUAGE
    ) {
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getUri(): UriInterface
    {
        return new Uri($this->baseUrl);
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public static function fromArray(array $params): static
    {
        return new self(
            apiKey: $params['apiKey'],
            secretKey: $params['secretKey'],
            baseUrl: $params['baseUrl'] ?? self::BASE_URL,
            language: $params['language'] ?? self::LANGUAGE
        );
    }

    public function toArray(): array
    {
        return [
            'apiKey' => $this->apiKey,
            'secretKey' => $this->secretKey,
            'baseUrl' => $this->baseUrl,
            'language' => $this->language,
        ];
    }
}
