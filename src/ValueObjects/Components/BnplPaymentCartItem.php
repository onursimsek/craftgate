<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Components;

use OnurSimsek\Craftgate\Enums\BnplCartItemType;
use OnurSimsek\Craftgate\ValueObjects\ValueObject;

class BnplPaymentCartItem extends ValueObject
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $brandName,
        public readonly BnplCartItemType $type,
        public readonly float $unitPrice,
        public readonly int $quantity,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            id: $params['id'],
            name: $params['name'],
            brandName: $params['brandName'],
            type: self::hydrate($params['type'], BnplCartItemType::class),
            unitPrice: $params['unitPrice'],
            quantity: $params['quantity'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brandName' => $this->brandName,
            'type' => $this->type->value,
            'unitPrice' => $this->unitPrice,
            'quantity' => $this->quantity,
        ];
    }
}
