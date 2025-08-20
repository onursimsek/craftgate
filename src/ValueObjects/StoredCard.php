<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

class StoredCard extends ValueObject implements LoyaltyCard
{
    public function __construct(public readonly string $userKey, public readonly string $token)
    {
    }

    public static function fromArray(array $params): static
    {
        return new static($params['cardUserKey'], $params['cardToken']);
    }

    public function toArray(): array
    {
        return [
            'cardUserKey' => $this->userKey,
            'cardToken' => $this->token,
        ];
    }
}
