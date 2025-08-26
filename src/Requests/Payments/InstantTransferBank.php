<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\InstantTransferBankProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use Psr\Http\Message\ResponseInterface;

class InstantTransferBank extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function fetch(): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('instant-transfer-banks')
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(InstantTransferBankProxy::class, $this);
    }
}
