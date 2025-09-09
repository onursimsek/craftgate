<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\BnplProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CreateBnplPayment;
use OnurSimsek\Craftgate\ValueObjects\SearchBnplOffer;
use Psr\Http\Message\ResponseInterface;

class Bnpl extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function offers(SearchBnplOffer $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('bnpl-payments', 'offers')
            ->withBody($data->toArray())
            ->psrSend();
    }

    public function create(CreateBnplPayment $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('bnpl-payments', 'init')
            ->withBody($data->toArray())
            ->psrSend();
    }

    public function approve(int $paymentId): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('bnpl-payments', $paymentId, 'approve')
            ->psrSend();
    }

    public function verify(int $paymentId): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('bnpl-payments', $paymentId, 'verify')
            ->psrSend();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(BnplProxy::class, $this);
    }
}
