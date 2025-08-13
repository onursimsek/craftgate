<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\GarantiPayProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CreateGarantiPayV1;
use Psr\Http\Message\ResponseInterface;

class GarantiPay extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(CreateGarantiPayV1 $payment): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('garanti-pay-payments')
            ->withBody($payment->toArray())
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(GarantiPayProxy::class);
    }
}
