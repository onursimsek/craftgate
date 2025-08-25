<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\BnplProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
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
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(BnplProxy::class, $this);
    }
}
