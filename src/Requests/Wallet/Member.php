<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Wallet;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Proxies\Wallet\MemberProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use Psr\Http\Message\ResponseInterface;

class Member extends RequestDecorator
{
    protected string $prefix = 'wallet';

    public function __construct(RequestInterface $request, private int $id)
    {
        parent::__construct($request);
    }

    public function createWallet(float $negativeAmountLimit = null, Currency $currency = null): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('members', $this->id, 'wallets')
            ->withBody([
                'negativeAmountLimit' => $negativeAmountLimit,
                'currency' => $currency?->value,
            ])
            ->send();
    }

    public function fetchWallet(): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('members', $this->id, 'wallet')
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(MemberProxy::class, $this);
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }
}
