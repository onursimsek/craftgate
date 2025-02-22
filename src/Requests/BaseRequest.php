<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use OnurSimsek\Craftgate\Util;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class BaseRequest implements RequestInterface
{
    protected PsrRequestInterface $request;

    public function __construct(public readonly Options $options, protected readonly ClientInterface $client)
    {
        $this->request = new Request('GET', $options->getUri());
        $this->request = $this->request->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader(Header::ClientVersion->value, 'onursimsek/craftgate:1.0.0')
            ->withHeader(Header::AuthVersion->value, 'v1')
            ->withHeader(Header::ApiKey->value, $options->getApiKey());
    }

    public function options(): Options
    {
        return $this->options;
    }

    public function psrRequest(): PsrRequestInterface
    {
        return $this->request;
    }

    public function withUri(UriInterface $uri): RequestInterface
    {
        $this->request = $this->request->withUri($uri);
        return $this;
    }

    public function withPath(...$sections): RequestInterface
    {
        $this->request = $this->request->withUri(
            $this->request->getUri()->withPath(implode('/', $sections))
        );

        return $this;
    }

    public function withQuery(array $params): RequestInterface
    {
        $this->request = $this->request->withUri(
            $this->request->getUri()->withQuery(http_build_query($params))
        );

        return $this;
    }

    public function withMethod(string $method): RequestInterface
    {
        $this->request = $this->request->withMethod($method);
        return $this;
    }

    public function withHeader(string $header, string $value): RequestInterface
    {
        $this->request = $this->request->withHeader($header, $value);
        return $this;
    }

    public function withBody(array $body): RequestInterface
    {
        $this->request = $this->request->withBody(
            Utils::streamFor(json_encode($body))
        );
        return $this;
    }

    public function send(): ResponseInterface
    {
        return $this->client->sendRequest(
            $this->withHeader(Header::RandomKey->value, $guid = Util::guid())
                ->withHeader(Header::Signature->value, Util::signature($this, $guid))
                ->psrRequest()
        );
    }
}
