<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\ValueObjects\Components\Installments;
use OnurSimsek\Craftgate\ValueObjects\Components\PaymentItem;

class CreateGarantiPayV1 extends ValueObject
{
    public function __construct(
        public readonly float $price,
        public readonly float $paidPrice,
        public readonly string $callbackUrl,
        public readonly array $items,
        public readonly Currency $currency = Currency::TL,
        public readonly Installments $installments,
        public readonly ?string $conversationId = null,
        public readonly ?string $externalId = null,
        public readonly ?int $buyerMemberId = null,
        public readonly ?PaymentGroup $paymentGroup = null,
        public readonly ?string $paymentChannel = null,
        public readonly ?string $bankOrderId = null,
        public readonly ?string $clientIp = null,
        public readonly ?string $posAlias = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            price: $params['price'],
            paidPrice: $params['paidPrice'],
            callbackUrl: $params['callbackUrl'],
            items: self::hydrate($params['items'], PaymentItem::class, true),
            currency: $params['currency'] ?? Currency::TL,
            installments: Installments::fromArray($params['installments']),
            conversationId: $params['conversationId'] ?? null,
            externalId: $params['externalId'] ?? null,
            buyerMemberId: $params['buyerMemberId'] ?? null,
            paymentGroup: self::hydrate($params['paymentGroup'] ?? null, PaymentGroup::class),
            paymentChannel: $params['paymentChannel'] ?? null,
            bankOrderId: $params['bankOrderId'] ?? null,
            clientIp: $params['clientIp'] ?? null,
            posAlias: $params['posAlias'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'paidPrice' => $this->paidPrice,
            'callbackUrl' => $this->callbackUrl,
            'items' => $this->items,
            'currency' => $this->currency->value,
            'installments' => $this->installments->toArray(),
            'conversationId' => $this->conversationId,
            'externalId' => $this->externalId,
            'buyerMemberId' => $this->buyerMemberId,
            'paymentGroup' => $this->paymentGroup?->value,
            'paymentChannel' => $this->paymentChannel,
            'bankOrderId' => $this->bankOrderId,
            'clientIp' => $this->clientIp,
            'posAlias' => $this->posAlias,
        ];
    }
}
