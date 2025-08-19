<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\PosApmPayment;
use OnurSimsek\Craftgate\ValueObjects\InitializePosApmPayment;
use Psr\Http\Message\ResponseInterface;

final class PosApmPaymentProxy implements Proxy
{
    public function __construct(public readonly PosApmPayment $decorator)
    {
    }

    public function initApmPayment(array $params): ResponseInterface
    {
        return $this->decorator->init(InitializePosApmPayment::fromArray($params));
    }

    public function completeApmPayment(array $params): ResponseInterface
    {
        return $this->decorator->complete($params['paymentId']);
    }
}
