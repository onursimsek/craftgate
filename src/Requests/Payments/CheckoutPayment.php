<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\CheckoutPaymentProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CheckoutPayment as CheckoutPaymentValueObject;
use Psr\Http\Message\ResponseInterface;

/**
 * @mixin CheckoutPaymentProxy
 */
final class CheckoutPayment extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function init(CheckoutPaymentValueObject $param): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('checkout-payments', 'init')
            ->withBody($param->toArray())
            ->send();
    }

    public function fetch(string $token): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('checkout-payments', $token)
            ->send();
    }

    public function expire(string $token): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Delete)
            ->withPath('checkout-payments', $token)
            ->send();
    }

    protected function proxy(): Proxy
    {
        return $this->proxy ??= new CheckoutPaymentProxy($this);
    }
}
