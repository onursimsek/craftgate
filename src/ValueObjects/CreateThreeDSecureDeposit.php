<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\ValueObjects\Components\Card;

class CreateThreeDSecureDeposit extends ValueObject
{
    public function __construct(
        public readonly float $price,
        public readonly int $buyerMemberId,
        public readonly Card $card,
        public readonly Currency $currency = Currency::TL,
        public readonly string $callbackUrl,
        public readonly ?string $conversationId = null,
        public readonly ?string $posAlias = null,
        public readonly ?string $clientIp = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            price: $params['price'],
            buyerMemberId: $params['buyerMemberId'],
            card: self::hydrate($params['card'], Card::class),
            currency: $params['currency'] ?? Currency::TL,
            callbackUrl: $params['callbackUrl'] ?? null,
            conversationId: $params['conversationId'] ?? null,
            posAlias: $params['posAlias'] ?? null,
            clientIp: $params['clientIp'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'buyerMemberId' => $this->buyerMemberId,
            'card' => $this->card->toArray(),
            'currency' => $this->currency->value,
            'callbackUrl' => $this->callbackUrl,
            'conversationId' => $this->conversationId,
            'posAlias' => $this->posAlias,
            'clientIp' => $this->clientIp,
        ];
    }
}
