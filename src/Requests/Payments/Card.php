<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\CardProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\CreateStoredCard;
use OnurSimsek\Craftgate\ValueObjects\SearchStoredCard;
use OnurSimsek\Craftgate\ValueObjects\UpdateStoredCard;
use Psr\Http\Message\ResponseInterface;

class Card extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(CreateStoredCard $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('cards')
            ->withBody($data->toArray())
            ->send();
    }

    public function update(UpdateStoredCard $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('cards', 'update')
            ->withBody($data->toArray())
            ->send();
    }

    public function search(SearchStoredCard $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('cards')
            ->withQuery($data->toArray())
            ->send();
    }

    public function delete(string $cardUserKey, string $cardToken): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Delete)
            ->withPath('cards', 'delete')
            ->withBody([
                'cardUserKey' => $cardUserKey,
                'cardToken' => $cardToken,
            ])
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(CardProxy::class, $this);
    }
}
