<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

class UpdateStoredCard extends ValueObject
{
    public function __construct(
        public readonly string $cardUserKey,
        public readonly string $cardToken,
        public readonly string $expireYear,
        public readonly string $expireMonth,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            cardUserKey: $params['cardUserKey'],
            cardToken: $params['cardToken'],
            expireYear: $params['expireYear'],
            expireMonth: $params['expireMonth'],
        );
    }

    public function toArray(): array
    {
        return [
            'cardUserKey' => $this->cardUserKey,
            'cardToken' => $this->cardToken,
            'expireYear' => $this->expireYear,
            'expireMonth' => $this->expireMonth,
        ];
    }
}
