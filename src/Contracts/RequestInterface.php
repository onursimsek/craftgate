<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Contracts;

use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

interface RequestInterface
{
    public function options(): Options;

    public function psrRequest(): PsrRequestInterface;

    public function withUri(UriInterface $uri): self;
    public function withPath(...$sections): self;
    public function withQuery(array $params): self;

    public function withMethod(string $method): self;

    public function withBody(array $body): self;

    public function send(): ResponseInterface;
}
