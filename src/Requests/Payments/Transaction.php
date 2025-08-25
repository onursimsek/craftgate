<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\TransactionProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use Psr\Http\Message\ResponseInterface;

class Transaction extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function approve(array $ids, bool $isTransactional): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('payment-transactions', 'approve')
            ->withBody([
                'paymentTransactionIds' => $ids,
                'isTransactional' => $isTransactional,
            ])
            ->send();
    }

    public function disapprove(array $ids, bool $isTransactional): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('payment-transactions', 'disapprove')
            ->withBody([
                'paymentTransactionIds' => $ids,
                'isTransactional' => $isTransactional,
            ])
            ->send();
    }

    public function update(string $paymentTransactionId, int $subMerchantMemberId, int $subMerchantMemberPrice): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Put)
            ->withPath('payment-transactions', $paymentTransactionId)
            ->withBody([
                'subMerchantMemberId' => $subMerchantMemberId,
                'subMerchantMemberPrice' => $subMerchantMemberPrice,
            ])
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(TransactionProxy::class, $this);
    }
}
