<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\RefundDestinationType;

class CreateRefund extends ValueObject
{
    public function __construct(
        public readonly int $paymentId,
        public readonly ?string $conversationId = null,
        public readonly ?RefundDestinationType $refundDestinationType = null,
        public readonly ?bool $chargeFromMe = null
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            paymentId: $params['paymentTransactionId'],
            conversationId: $params['conversationId'] ?? null,
            refundDestinationType: self::hydrate($params['refundDestinationType'] ?? null, RefundDestinationType::class),
            chargeFromMe: $params['chargeFromMe'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'paymentTransactionId' => $this->paymentId,
            'conversationId' => $this->conversationId,
            'refundDestinationType' => $this->refundDestinationType?->value,
            'chargeFromMe' => $this->chargeFromMe,
        ];
    }
}
