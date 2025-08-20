<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

class Card extends ValueObject implements LoyaltyCard
{
    public function __construct(
        public readonly string $number,
        public readonly string $expireYear,
        public readonly string $expireMonth,
        public readonly ?string $cvc = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            $params['cardNumber'],
            $params['expireYear'],
            $params['expireMonth'],
            $params['cvc'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'cardNumber' => $this->number,
            'expireYear' => $this->expireYear,
            'expireMonth' => $this->expireMonth,
            'cvc' => $this->cvc,
        ];
    }
}
