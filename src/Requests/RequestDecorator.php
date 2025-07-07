<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\ForwardCallsToProxy;
use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

abstract class RequestDecorator implements RequestInterface
{
    use ForwardCallsToProxy;

    protected string $version = 'v1';

    protected string $prefix;

    /**
     * @param  RequestInterface&BaseRequest  $request
     */
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
        $this->request->withUri($uri);

        return $this;
    }

    public function withPath(...$sections): RequestInterface
    {
        $this->request->withPath($this->prefix, $this->version, ...$sections);

        return $this;
    }

    public function withQuery(array $params): RequestInterface
    {
        $this->request->withQuery($params);

        return $this;
    }

    public function withMethod(string $method): RequestInterface
    {
        $this->request->withMethod($method);

        return $this;
    }

    public function withBody(array $body): RequestInterface
    {
        $this->request->withBody($body);

        return $this;
    }

    public function send(): ResponseInterface
    {
        return $this->request->send();
    }

    abstract protected function proxy(): Proxy;
}
