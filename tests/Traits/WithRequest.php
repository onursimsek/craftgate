<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Traits;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

trait WithRequest
{
    protected string $baseUrl = 'http://localhost:8000';

    protected MockHandler $fakeServer;

    private function client()
    {
        return $this->createConfiguredMock(ClientInterface::class, [
            'sendRequest' => $this->createConfiguredMock(ResponseInterface::class, []),
        ]);
    }

    public function baseRequest(string $path = '', array $query = [], array $params = [])
    {
        return $this->createConfiguredMock(RequestInterface::class, [
            'options' => $this->options(),
            'psrRequest' => $this->psrRequest($path, $query, $params),
        ]);
    }

    private function options()
    {
        return $this->createConfiguredMock(Options::class, [
            'getApiKey' => 'api-key',
            'getSecretKey' => 'secret-key',
            'getBaseUrl' => $this->baseUrl,
            'getUri' => new Uri($this->baseUrl),
        ]);
    }

    private function psrRequest(string $path = '', array $query = [], array $params = [])
    {
        return $this->createConfiguredMock(PsrRequestInterface::class, [
            'getUri' => (new Uri($this->baseUrl))
                ->withPath($path)
                ->withQuery(http_build_query($query)),
            'getBody' => $this->createConfiguredMock(StreamInterface::class, [
                'getSize' => $params ? 1 : 0,
                'getContents' => json_encode($params),
            ]),
        ]);
    }

    public function fakeServer(): MockHandler
    {
        return $this->fakeServer = new MockHandler();
    }

    public function addResponse(int $status, string $body): void
    {
        $this->fakeServer->append(new Response($status, [], $body));
    }
}
