<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\RefundDestinationType;

class CreateRefundTransaction extends ValueObject
{
    public function __construct(
        public readonly int $paymentTransactionId,
        public readonly ?string $conversationId = null,
        public readonly ?float $refundPrice = null,
        public readonly ?RefundDestinationType $refundDestinationType = null,
        public readonly ?bool $chargeFromMe = null
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            paymentTransactionId: $params['paymentTransactionId'],
            conversationId: $params['conversationId'] ?? null,
            refundPrice: $params['refundPrice'] ?? null,
            refundDestinationType: self::hydrate($params['refundDestinationType'] ?? null, RefundDestinationType::class),
            chargeFromMe: $params['chargeFromMe'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'paymentTransactionId' => $this->paymentTransactionId,
            'conversationId' => $this->conversationId,
            'refundPrice' => $this->refundPrice,
            'refundDestinationType' => $this->refundDestinationType?->value,
            'chargeFromMe' => $this->chargeFromMe,
        ];
    }
}
