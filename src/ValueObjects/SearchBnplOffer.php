<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\ApmType;
use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\ValueObjects\Components\BnplPaymentCartItem;

class SearchBnplOffer extends ValueObject
{
    public function __construct(
        public readonly ApmType $apmType,
        public readonly float $price,
        public readonly array $items,
        public readonly Currency $currency = Currency::TL,
        public readonly array $additionalParams = [],
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            apmType: self::hydrate($params['apm_type'], ApmType::class),
            price: $params['price'],
            items: self::hydrate($params['items'], BnplPaymentCartItem::class, true),
            currency: $params['currency'] ?? Currency::TL,
            additionalParams: $params['additional_params'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'apmType' => $this->apmType->value,
            'price' => $this->price,
            'items' => self::dehydrateList($this->items),
            'currency' => $this->currency->value,
            'additionalParams' => $this->additionalParams,
        ];
    }
}
