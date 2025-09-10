<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Wallet;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\RemittanceReason;
use OnurSimsek\Craftgate\ValueObjects\ValueObject;

class Remittance extends ValueObject
{
    public function __construct(
        public readonly int $memberId,
        public readonly float $price,
        public readonly Currency $currency,
        public readonly string $description,
        public readonly RemittanceReason $remittanceReasonType = RemittanceReason::RedeemOnlyLoyalty
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            memberId: $params['memberId'],
            price: $params['price'],
            currency: self::hydrate($params['currency'], Currency::class),
            description: $params['description'],
            remittanceReasonType: $params['remittanceReasonType'] ?? RemittanceReason::RedeemOnlyLoyalty
        );
    }

    public function toArray(): array
    {
        return [
            'memberId' => $this->memberId,
            'price' => $this->price,
            'currency' => $this->currency->value,
            'description' => $this->description,
            'remittanceReasonType' => $this->remittanceReasonType->value,
        ];
    }
}
