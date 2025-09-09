<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Wallet;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use Psr\Http\Message\ResponseInterface;

class Remittance extends RequestDecorator
{
    protected string $prefix = 'wallet';

    public function send($data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath()
            ->withBody($data->toArray())
            ->psrSend();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(RemittanceProxy::class, $this);
    }
}
