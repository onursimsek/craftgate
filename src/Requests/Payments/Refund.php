<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\RefundProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CreateRefund;
use Psr\Http\Message\ResponseInterface;

class Refund extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(CreateRefund $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('refunds')
            ->withBody($data->toArray())
            ->send();
    }

    public function fetch(int $id): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('refunds', $id)
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(RefundProxy::class, $this);
    }
}
