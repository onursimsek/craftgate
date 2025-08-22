<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\Refund;
use OnurSimsek\Craftgate\ValueObjects\CreateRefund;
use Psr\Http\Message\ResponseInterface;

final class RefundProxy implements Proxy
{
    public function __construct(public readonly Refund $decorator)
    {
    }

    public function refundPayment(array $params): ResponseInterface
    {
        return $this->decorator->create(CreateRefund::fromArray($params));
    }

    public function retrievePaymentRefund(int $refundId): ResponseInterface
    {
        return $this->decorator->fetch($refundId);
    }
}
