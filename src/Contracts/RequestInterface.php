<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Contracts;

use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RequestInterface
{
    public function options(): Options;
    public function psrRequest(): PsrRequestInterface;
    public function send(): ResponseInterface;
}
