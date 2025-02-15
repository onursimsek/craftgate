<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Traits;

use GuzzleHttp\Handler\MockHandler;
use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

trait WithRequest
{
    protected string $baseUrl = 'http://localhost:8000';
    protected string $endpoint = '';

    private function client()
    {
        return $this->createConfiguredMock(ClientInterface::class, [
            'sendRequest' => $this->createConfiguredMock(ResponseInterface::class, []),
        ]);
    }

    public function baseRequest(string $endpoint = '', array $params = [])
    {
        $this->endpoint = urldecode($endpoint);
        return $this->createConfiguredMock(RequestInterface::class, [
            'options' => $this->options(),
            'psrRequest' => $this->psrRequest($params),
        ]);
    }

    private function options()
    {
        return $this->createConfiguredMock(Options::class, [
            'getApiKey' => 'api-key',
            'getSecretKey' => 'secret-key',
            'getBaseUrl' => $this->baseUrl,
            'getUri' => $this->getUri(),
        ]);
    }

    private function psrRequest(array $params = [])
    {
        return $this->createConfiguredMock(PsrRequestInterface::class, [
            'getUri' => $this->getUri(),
            'getBody' => $this->createConfiguredMock(StreamInterface::class, [
                'getSize' => $params ? 1 : 0,
                'getContents' => json_encode($params),
            ]),
        ]);
    }

    private function getUri()
    {
        return $this->createConfiguredMock(UriInterface::class, [
            '__toString' => $this->baseUrl . $this->endpoint,
        ]);
    }

    public function fakeServer(): MockHandler
    {
        return new MockHandler();
    }
}
