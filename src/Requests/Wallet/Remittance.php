<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Wallet;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\Wallet\RemittanceProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\Wallet\Remittance as RemittanceValueObject;
use Psr\Http\Message\ResponseInterface;

class Remittance extends RequestDecorator
{
    protected string $prefix = 'wallet';

    public function send(RemittanceValueObject $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('remittances', 'send')
            ->withBody($data->toArray())
            ->psrSend();
    }

    public function receive(RemittanceValueObject $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('remittances', 'receive')
            ->withBody($data->toArray())
            ->psrSend();
    }

    public function fetch(int $id): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('remittances', $id)
            ->psrSend();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(RemittanceProxy::class, $this);
    }
}
