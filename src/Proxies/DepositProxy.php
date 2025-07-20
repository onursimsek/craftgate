<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\Deposit;
use Psr\Http\Message\ResponseInterface;

final class DepositProxy implements Proxy
{
    public function __construct(public readonly Deposit $decorator)
    {
    }

    public function createDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->create($params);
    }

    public function init3DSDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->createThreeDSecure($params);
    }

    public function complete3DSDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->completeThreeDSecure($params);
    }

    public function createFundTransferDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->createFundTransfer($params);
    }

    public function initApmDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->createApm($params);
    }
}
