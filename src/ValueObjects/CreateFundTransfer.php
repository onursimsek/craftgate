<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;

class CreateFundTransfer extends ValueObject
{
    public function __construct(
        public readonly float $price,
        public readonly int $buyerMemberId,
        public readonly Currency $currency = Currency::TL,
        public readonly ?string $conversationId,
        public readonly ?string $clientIp,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            price: $params['price'],
            buyerMemberId: $params['buyerMemberId'],
            currency: $params['currency'] ?? Currency::TL,
            conversationId: $params['conversationId'] ?? null,
            clientIp: $params['clientIp'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'buyerMemberId' => $this->buyerMemberId,
            'currency' => $this->currency->value,
            'conversationId' => $this->conversationId,
            'clientIp' => $this->clientIp,
        ];
    }
}
