<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\DepositProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CreateApmDeposit;
use OnurSimsek\Craftgate\ValueObjects\CreateDeposit;
use OnurSimsek\Craftgate\ValueObjects\CreateFundTransfer;
use OnurSimsek\Craftgate\ValueObjects\CreateThreeDSecureDeposit;
use Psr\Http\Message\ResponseInterface;

/**
 * @mixin DepositProxy
 */
final class Deposit extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(CreateDeposit $params): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('deposits')
            ->withBody($params->toArray())
            ->send();
    }

    public function createThreeDSecure(CreateThreeDSecureDeposit $params): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('deposits', '3ds-init')
            ->withBody($params->toArray())
            ->send();
    }

    public function completeThreeDSecure(int $paymentId): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('deposits', '3ds-complete')
            ->withBody(['paymentId' => $paymentId])
            ->send();
    }

    public function createApm(CreateApmDeposit $params): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('deposits', 'apm-init')
            ->withBody($params->toArray())
            ->send();
    }

    public function createFundTransfer(CreateFundTransfer $params): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('deposits', 'fund-transfer')
            ->withBody($params->toArray())
            ->send();
    }

    protected function proxy(): Proxy
    {
        return $this->proxy ??= new DepositProxy($this);
    }
}
