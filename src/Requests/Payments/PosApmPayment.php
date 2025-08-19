<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\ApmPaymentProxy;
use OnurSimsek\Craftgate\Proxies\PosApmPaymentProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\InitializePosApmPayment;
use OnurSimsek\Craftgate\ValueObjects\CreateApmPayment;
use OnurSimsek\Craftgate\ValueObjects\InitializeApmPayment;
use Psr\Http\Message\ResponseInterface;

class PosApmPayment extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function init(InitializePosApmPayment $payment): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('pos-apm-payments', 'init')
            ->withBody($payment->toArray())
            ->send();
    }

    public function complete(int $paymentId): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('pos-apm-payments', 'complete')
            ->withBody(['paymentId' => $paymentId])
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(PosApmPaymentProxy::class, $this);
    }
}
