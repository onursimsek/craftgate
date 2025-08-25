<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\Transaction;
use Psr\Http\Message\ResponseInterface;

final class TransactionProxy implements Proxy
{
    public function __construct(public readonly Transaction $decorator)
    {
    }

    public function approvePaymentTransactions(array $params): ResponseInterface
    {
        return $this->decorator->approve($params['paymentTransactionIds'], $params['isTransactional']);
    }

    public function disapprovePaymentTransactions(array $params): ResponseInterface
    {
        return $this->decorator->disapprove($params['paymentTransactionIds'], $params['isTransactional']);
    }

    public function updatePaymentTransaction($paymentTransactionId, array $params): ResponseInterface
    {
        return $this->decorator->update($paymentTransactionId, $params['subMerchantMemberId'], $params['subMerchantMemberPrice']);
    }
}
