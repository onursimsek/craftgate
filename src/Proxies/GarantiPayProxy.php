<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\GarantiPay;
use OnurSimsek\Craftgate\ValueObjects\CreateGarantiPayV1;
use Psr\Http\Message\ResponseInterface;

final class GarantiPayProxy implements Proxy
{
    public function __construct(public readonly GarantiPay $decorator)
    {
    }

    public function initGarantiPayPayment(array $params): ResponseInterface
    {
        return $this->decorator->create(CreateGarantiPayV1::fromArray($params));
    }
}
