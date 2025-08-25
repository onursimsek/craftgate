<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Requests\Payments\Card;
use OnurSimsek\Craftgate\Contracts\Proxy;
use Psr\Http\Message\ResponseInterface;

final class CardProxy implements Proxy
{
    public function __construct(public readonly Card $decorator)
    {
    }

    public function storeCard(array $params): ResponseInterface
    {
        return $this->decorator->create($params);
    }

    public function updateCard(array $params): ResponseInterface
    {
        return $this->decorator->update($params);
    }

    public function cloneCard(array $params): ResponseInterface
    {
        return $this->decorator->clone($params);
    }

    public function searchStoredCards(array $params): ResponseInterface
    {
        return $this->decorator->search($params);
    }

    public function deleteStoredCard(array $params): ResponseInterface
    {
        return $this->decorator->delete($params);
    }
}
