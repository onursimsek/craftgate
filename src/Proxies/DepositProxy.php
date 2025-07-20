<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\Deposit;
use OnurSimsek\Craftgate\ValueObjects\CreateApmDeposit;
use OnurSimsek\Craftgate\ValueObjects\CreateDeposit;
use OnurSimsek\Craftgate\ValueObjects\CreateFundTransfer;
use OnurSimsek\Craftgate\ValueObjects\CreateThreeDSecureDeposit;
use Psr\Http\Message\ResponseInterface;

final class DepositProxy implements Proxy
{
    public function __construct(public readonly Deposit $decorator)
    {
    }

    public function createDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->create(CreateDeposit::fromArray($params));
    }

    public function init3DSDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->createThreeDSecure(CreateThreeDSecureDeposit::fromArray($params));
    }

    public function complete3DSDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->completeThreeDSecure($params['paymentId']);
    }

    public function createFundTransferDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->createFundTransfer(CreateFundTransfer::fromArray($params));
    }

    public function initApmDepositPayment(array $params): ResponseInterface
    {
        return $this->decorator->createApm(CreateApmDeposit::fromArray($params));
    }
}
