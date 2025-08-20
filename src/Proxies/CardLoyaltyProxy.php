<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\CardLoyalty;
use OnurSimsek\Craftgate\ValueObjects\Card;
use OnurSimsek\Craftgate\ValueObjects\LoyaltyCard;
use OnurSimsek\Craftgate\ValueObjects\StoredCard;
use Psr\Http\Message\ResponseInterface;

final class CardLoyaltyProxy implements Proxy
{
    public function __construct(public readonly CardLoyalty $decorator)
    {
    }

    public function retrieveLoyalties(array $params): ResponseInterface
    {
        return $this->decorator->retrieve($this->getValueObject($params));
    }

    private function getValueObject(array $params): LoyaltyCard
    {
        return array_diff(array_keys($params), ['cardUserKey', 'cardToken'])
            ? StoredCard::fromArray($params)
            : Card::fromArray($params);
    }
}
