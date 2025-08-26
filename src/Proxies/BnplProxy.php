<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\Bnpl;
use OnurSimsek\Craftgate\ValueObjects\CreateBnplPayment;
use OnurSimsek\Craftgate\ValueObjects\SearchBnplOffer;
use Psr\Http\Message\ResponseInterface;

final class BnplProxy implements Proxy
{
    public function __construct(public readonly Bnpl $decorator)
    {
    }

    public function retrieveBnplOffers(array $params): ResponseInterface
    {
        return $this->decorator->offers(SearchBnplOffer::fromArray($params));
    }

    public function initBnplPayment(array $params): ResponseInterface
    {
        return $this->decorator->create(CreateBnplPayment::fromArray($params));
    }

    public function approveBnplPayment(int $paymentId): ResponseInterface
    {
        return $this->decorator->approve($paymentId);
    }
}
