<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\ApmPaymentProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CreateApmPayment;
use OnurSimsek\Craftgate\ValueObjects\InitializeApmPayment;
use Psr\Http\Message\ResponseInterface;

class ApmPayment extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(CreateApmPayment $payment): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('apm-payments')
            ->withBody($payment->toArray())
            ->send();
    }

    public function init(InitializeApmPayment $payment): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('apm-payments', 'init')
            ->withBody($payment->toArray())
            ->send();
    }

    public function complete(int $paymentId, array $additionalParams): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('apm-payments', 'complete')
            ->withBody([
                'paymentId' => $paymentId,
                'additionalParams' => $additionalParams,
            ])
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(ApmPaymentProxy::class, $this);
    }
}
