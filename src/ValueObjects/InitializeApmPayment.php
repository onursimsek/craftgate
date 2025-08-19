<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\ApmType;
use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;

class InitializeApmPayment extends BaseApmPayment
{
    public function __construct(
        float $price,
        float $paidPrice,
        array $items,
        ApmType $apmType,
        PaymentGroup $paymentGroup,
        Currency $currency = Currency::TL,
        ?string $paymentChannel = null,
        ?string $conversationId = null,
        ?string $externalId = null,
        ?int $buyerMemberId = null,
        ?string $apmOrderId = null,
        public readonly ?string $apmUserIdentity = null,
        public readonly ?int $merchantApmId = null,
        public readonly ?string $callbackUrl = null,
        public readonly array $additionalParams = [],
        ?string $clientIp = null
    ) {
        parent::__construct($price, $paidPrice, $items, $apmType, $paymentGroup, $currency, $paymentChannel, $conversationId, $externalId, $buyerMemberId, $apmOrderId, $clientIp);
    }

    public static function fromArray(array $params): static
    {
        return new static(
            price: $params['price'],
            paidPrice: $params['paidPrice'],
            items: self::hydrate($params['items'], PaymentItem::class, true),
            apmType: self::hydrate($params['apmType'], ApmType::class),
            paymentGroup: self::hydrate($params['paymentGroup'], PaymentGroup::class),
            currency: $params['currency'] ?? Currency::TL,
            paymentChannel: $params['paymentChannel'] ?? null,
            conversationId: $params['conversationId'] ?? null,
            externalId: $params['externalId'] ?? null,
            buyerMemberId: $params['buyerMemberId'] ?? null,
            apmOrderId: $params['apmOrderId'] ?? null,
            apmUserIdentity: $params['apmUserIdentity'] ?? null,
            merchantApmId: $params['merchantApmId'] ?? null,
            callbackUrl: $params['callbackUrl'] ?? null,
            additionalParams: $params['additionalParams'] ?? [],
            clientIp: $params['clientIp'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'apmUserIdentity' => $this->apmUserIdentity,
            'merchantApmId' => $this->merchantApmId,
            'callbackUrl' => $this->callbackUrl,
            'additionalParams' => $this->additionalParams,
        ]);
    }
}
