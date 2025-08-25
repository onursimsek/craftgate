<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Requests\Payments\Card;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\ValueObjects\CreateStoredCard;
use OnurSimsek\Craftgate\ValueObjects\SearchStoredCard;
use OnurSimsek\Craftgate\ValueObjects\UpdateStoredCard;
use Psr\Http\Message\ResponseInterface;

final class CardProxy implements Proxy
{
    public function __construct(public readonly Card $decorator)
    {
    }

    public function storeCard(array $params): ResponseInterface
    {
        return $this->decorator->create(CreateStoredCard::fromArray($params));
    }

    public function updateCard(array $params): ResponseInterface
    {
        return $this->decorator->update(UpdateStoredCard::fromArray($params));
    }

    public function searchStoredCards(array $params): ResponseInterface
    {
        return $this->decorator->search(SearchStoredCard::fromArray($params));
    }

    public function deleteStoredCard(array $params): ResponseInterface
    {
        return $this->decorator->delete($params['cardUserKey'], $params['cardToken']);
    }
}
