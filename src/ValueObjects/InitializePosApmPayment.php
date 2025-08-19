<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\Enums\PaymentPhase;
use OnurSimsek\Craftgate\Enums\PaymentProvider;
use OnurSimsek\Craftgate\ValueObjects\Components\FraudCheck;
use OnurSimsek\Craftgate\ValueObjects\Components\Installments;
use OnurSimsek\Craftgate\ValueObjects\Components\PaymentItem;

class InitializePosApmPayment extends ValueObject
{
    public function __construct(
        public readonly float $price,
        public readonly float $paidPrice,
        public readonly array $items,
        public readonly string $callbackUrl,
        public readonly PaymentPhase $paymentPhase,
        public readonly PaymentProvider $paymentProvider,
        public readonly array $additionalParams,
        public readonly Currency $currency = Currency::TL,
        public readonly ?Installments $installments = null,
        public readonly ?PaymentGroup $paymentGroup = null,
        public readonly ?FraudCheck $fraudParams = null,
        public readonly ?string $paymentChannel = null,
        public readonly ?string $conversationId = null,
        public readonly ?string $externalId = null,
        public readonly ?int $buyerMemberId = null,
        public readonly ?string $bankOrderId = null,
        public readonly ?string $posAlias = null,
        public readonly ?string $clientIp = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            price: $params['price'],
            paidPrice: $params['paidPrice'],
            items: self::hydrate($params['items'], PaymentItem::class, true),
            callbackUrl: $params['callbackUrl'],
            paymentPhase: $params['paymentPhase'],
            paymentProvider: $params['paymentProvider'],
            additionalParams: $params['additionalParams'],
            currency: $params['currency'] ?? Currency::TL,
            installments: $params['installments'] ?? null,
            paymentGroup: self::hydrate($params['paymentGroup'] ?? null, PaymentGroup::class),
            fraudParams: $params['fraudParams'] ?? null,
            paymentChannel: $params['paymentChannel'] ?? null,
            conversationId: $params['conversationId'] ?? null,
            externalId: $params['externalId'] ?? null,
            buyerMemberId: $params['buyerMemberId'] ?? null,
            bankOrderId: $params['bankOrderId'] ?? null,
            posAlias: $params['posAlias'] ?? null,
            clientIp: $params['clientIp'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'paidPrice' => $this->paidPrice,
            'items' => self::dehydrateList($this->items),
            'callbackUrl' => $this->callbackUrl,
            'paymentPhase' => $this->paymentPhase->value,
            'paymentProvider' => $this->paymentProvider->value,
            'additionalParams' => $this->additionalParams,
            'currency' => $this->currency,
            'installments' => $this->installments?->toArray(),
            'paymentGroup' => $this->paymentGroup->value,
            'fraudParams' => $this->fraudParams?->toArray(),
            'paymentChannel' => $this->paymentChannel,
            'conversationId' => $this->conversationId,
            'externalId' => $this->externalId,
            'buyerMemberId' => $this->buyerMemberId,
            'bankOrderId' => $this->bankOrderId,
            'posAlias' => $this->posAlias,
            'clientIp' => $this->clientIp,
        ];
    }
}
