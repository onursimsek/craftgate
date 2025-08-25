<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

class CreateStoredCard extends ValueObject
{
    public function __construct(
        public readonly string $cardHolderName,
        public readonly string $cardNumber,
        public readonly string $expireYear,
        public readonly string $expireMonth,
        public readonly ?string $cardAlias = null,
        public readonly ?string $cardUserKey = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            cardHolderName: $params['cardHolderName'],
            cardNumber: $params['cardNumber'],
            expireYear: $params['expireYear'],
            expireMonth: $params['expireMonth'],
            cardAlias: $params['cardAlias'] ?? null,
            cardUserKey: $params['cardUserKey'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'cardHolderName' => $this->cardHolderName,
            'cardNumber' => $this->cardNumber,
            'expireYear' => $this->expireYear,
            'expireMonth' => $this->expireMonth,
            'cardAlias' => $this->cardAlias,
            'cardUserKey' => $this->cardUserKey,
        ];
    }
}
