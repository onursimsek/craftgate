<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\RefundTransactionProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CreateRefundTransaction;
use Psr\Http\Message\ResponseInterface;

class RefundTransaction extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(CreateRefundTransaction $transaction): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('refund-transactions')
            ->withBody($transaction->toArray())
            ->send();
    }

    public function fetch(int $transactionId): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('refund-transactions', $transactionId)
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(RefundTransactionProxy::class, $this);
    }
}
