<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Components;

use OnurSimsek\Craftgate\ValueObjects\ValueObject;

class Installment extends ValueObject
{
    public function __construct(public readonly int $number, public readonly float $price)
    {
    }

    public static function fromArray(array $params): static
    {
        return new self(number: $params['number'], price: $params['price'] ?? $params['totalPrice']);
    }

    public function toArray(): array
    {
        return [
            'number' => $this->number,
            'totalPrice' => $this->price,
        ];
    }
}
