<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Endpoints;

use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

abstract class RequestDecorator implements RequestInterface
{
    protected string $version = 'v1';
    protected string $baseUrl;

    public function __construct(protected readonly RequestInterface $request)
    {
    }

    public function options(): Options
    {
        return $this->request->options();
    }

    public function psrRequest(): PsrRequestInterface
    {
        return $this->request->psrRequest();
    }

    public function withUri(UriInterface $uri): RequestInterface
    {
        return $this->request->withUri($uri);
    }

    public function withMethod(string $method): RequestInterface
    {
        return $this->request->withMethod($method);
    }

    public function send(): ResponseInterface
    {
        return $this->request->send();
    }

    protected function generatePath(string $endpoint): string
    {
        return sprintf('/%s/%s/%s', $this->baseUrl, $this->version, $endpoint);
    }
}
