<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use BackedEnum;
use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\DirectApmType;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\ValueObjects\Components\PaymentItem;

abstract class BaseApmPayment extends ValueObject
{
    public function __construct(
        public readonly float $price,
        public readonly float $paidPrice,
        public readonly array $items,
        public readonly BackedEnum $apmType,
        public readonly PaymentGroup $paymentGroup,
        public readonly Currency $currency = Currency::TL,
        public readonly ?string $paymentChannel = null,
        public readonly ?string $conversationId = null,
        public readonly ?string $externalId = null,
        public readonly ?int $buyerMemberId = null,
        public readonly ?string $apmOrderId = null,
        public readonly ?string $clientIp = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            price: $params['price'],
            paidPrice: $params['paidPrice'],
            items: self::hydrate($params['items'], PaymentItem::class, true),
            apmType: self::hydrate($params['apmType'], DirectApmType::class),
            paymentGroup: self::hydrate($params['paymentGroup'], PaymentGroup::class),
            currency: $params['currency'] ?? Currency::TL,
            paymentChannel: $params['paymentChannel'] ?? null,
            conversationId: $params['conversationId'] ?? null,
            externalId: $params['externalId'] ?? null,
            buyerMemberId: $params['buyerMemberId'] ?? null,
            apmOrderId: $params['apmOrderId'] ?? null,
            clientIp: $params['clientIp'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'apmType' => $this->apmType->value,
            'price' => $this->price,
            'paidPrice' => $this->paidPrice,
            'items' => self::dehydrateList($this->items),
            'paymentGroup' => $this->paymentGroup->value,
            'currency' => $this->currency,
            'conversationId' => $this->conversationId,
            'externalId' => $this->externalId,
            'buyerMemberId' => $this->buyerMemberId,
            'apmOrderId' => $this->apmOrderId,
            'clientIp' => $this->clientIp,
        ];
    }
}
