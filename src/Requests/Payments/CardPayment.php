<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\CardPaymentProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\Payment;
use Psr\Http\Message\ResponseInterface;

/**
 * @mixin CardPaymentProxy
 */
final class CardPayment extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(Payment $payment): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('card-payments')
            ->withBody($payment->toArray())
            ->send();
    }

    public function fetch(int $id): ResponseInterface
    {
        return $this->withPath('card-payments', $id)->send();
    }

    public function postAuth(int $id, array $params): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('card-payments', $id, 'post-auth')
            ->withBody($params)
            ->send();
    }

    public function initThreeDSecure(array $param): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('card-payments', '3ds-init')
            ->withBody($param)
            ->send();
    }

    public function completeThreeDSecure(array $param): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('card-payments', '3ds-complete')
            ->withBody($param)
            ->send();
    }

    protected function proxy(): Proxy
    {
        return $this->proxy ??= new CardPaymentProxy($this);
    }
}
