<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\MultiPaymentProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use Psr\Http\Message\ResponseInterface;

class MultiPayment extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function fetch(string $token): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('multi-payments', $token)
            ->psrSend();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(MultiPaymentProxy::class, $this);
    }
}
