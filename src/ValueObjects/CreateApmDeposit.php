<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\ValueObjects\Components\Card;

class CreateApmDeposit extends ValueObject
{
    public function __construct(
        public readonly float $price,
        public readonly int $buyerMemberId,
        public readonly Card $card,
        public readonly string $apmType,
        public readonly Currency $currency = Currency::TL,
        public readonly string $callbackUrl,
        public readonly ?string $conversationId = null,
        public readonly ?string $externalId = null,
        public readonly ?string $paymentChannel = null,
        public readonly ?int $merchantApmId = null,
        public readonly ?string $apmOrderId = null,
        public readonly ?string $apmUserIdentity = null,
        public readonly ?array $additionalParams = [],
        public readonly ?string $clientIp = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            price: $params['price'],
            buyerMemberId: $params['buyerMemberId'],
            card: self::hydrate($params['card'], Card::class),
            apmType: $params['apmType'],
            currency: $params['currency'] ?? Currency::TL,
            callbackUrl: $params['callbackUrl'] ?? null,
            conversationId: $params['conversationId'] ?? null,
            externalId: $params['externalId'] ?? null,
            paymentChannel: $params['paymentChannel'] ?? null,
            merchantApmId: $params['merchantApmId'] ?? null,
            apmOrderId: $params['apmOrderId'] ?? null,
            apmUserIdentity: $params['apmUserIdentity'] ?? null,
            additionalParams: $params['additionalParams'] ?? [],
            clientIp: $params['clientIp'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'buyerMemberId' => $this->buyerMemberId,
            'card' => $this->card->toArray(),
            'apmType' => $this->apmType,
            'currency' => $this->currency->value,
            'callbackUrl' => $this->callbackUrl,
            'conversationId' => $this->conversationId,
            'externalId' => $this->externalId,
            'paymentChannel' => $this->paymentChannel,
            'merchantApmId' => $this->merchantApmId,
            'apmOrderId' => $this->apmOrderId,
            'apmUserIdentity' => $this->apmUserIdentity,
            'additionalParams' => $this->additionalParams,
            'clientIp' => $this->clientIp,
        ];
    }
}
