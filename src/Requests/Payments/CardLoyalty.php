<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\CardLoyaltyProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\LoyaltyCard;
use Psr\Http\Message\ResponseInterface;

class CardLoyalty extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function fetch(LoyaltyCard $card): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('card-loyalties', 'retrieve')
            ->withBody($card->toArray())
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(CardLoyaltyProxy::class, $this);
    }
}
