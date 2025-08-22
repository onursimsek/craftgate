<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\RefundTransaction;
use OnurSimsek\Craftgate\ValueObjects\CreateRefundTransaction;
use Psr\Http\Message\ResponseInterface;

final class RefundTransactionProxy implements Proxy
{
    public function __construct(public readonly RefundTransaction $decorator)
    {
    }

    public function refundPaymentTransaction(array $params): ResponseInterface
    {
        return $this->decorator->create(CreateRefundTransaction::fromArray($params));
    }

    public function retrievePaymentTransactionRefund(int $refundTransactionId): ResponseInterface
    {
        return $this->decorator->fetch($refundTransactionId);
    }
}
