<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\ApmType;
use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\ValueObjects\Components\BnplPaymentCartItem;
use OnurSimsek\Craftgate\ValueObjects\Components\PaymentItem;

class CreateBnplPayment extends ValueObject
{
    public function __construct(
        public readonly ApmType $apmType,
        public readonly float $price,
        public readonly float $paidPrice,
        public readonly Currency $currency,
        public readonly PaymentGroup $paymentGroup,
        public readonly array $items,
        public readonly array $cartItems,
        public readonly ?int $merchantApmId = null,
        public readonly ?string $conversationId = null,
        public readonly ?string $externalId = null,
        public readonly ?int $buyerMemberId = null,
        public readonly ?string $paymentChannel = null,
        public readonly ?string $callbackUrl = null,
        public readonly ?string $apmOrderId = null,
        public readonly ?string $apmUserIdentity = null,
        public readonly array $additionalParams = [],
        public readonly ?string $clientIp = null,
        public readonly ?string $bankCode = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            apmType: $params['apm_type'],
            price: $params['price'],
            paidPrice: $params['paid_price'],
            currency: self::hydrate($params['currency'], Currency::class),
            paymentGroup: self::hydrate($params['payment_group'], PaymentGroup::class),
            items: self::hydrate($params['items'], PaymentItem::class, true),
            cartItems: self::hydrate($params['cart_items'], BnplPaymentCartItem::class, true),
            merchantApmId: $params['merchant_apm_id'] ?? null,
            conversationId: $params['conversation_id'] ?? null,
            externalId: $params['external_id'] ?? null,
            buyerMemberId: $params['buyer_member_id'] ?? null,
            paymentChannel: $params['payment_channel'] ?? null,
            callbackUrl: $params['callback_url'] ?? null,
            apmOrderId: $params['apm_order_id'] ?? null,
            apmUserIdentity: $params['apm_user_id'] ?? null,
            additionalParams: $params['additional_params'] ?? [],
            clientIp: $params['client_ip'] ?? null,
            bankCode: $params['bank_code'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'apmType' => $this->apmType,
            'merchantApmId' => $this->merchantApmId,
            'conversationId' => $this->conversationId,
            'externalId' => $this->externalId,
            'price' => $this->price,
            'paidPrice' => $this->paidPrice,
            'buyerMemberId' => $this->buyerMemberId,
            'currency' => $this->currency,
            'paymentGroup' => $this->paymentGroup,
            'paymentChannel' => $this->paymentChannel,
            'callbackUrl' => $this->callbackUrl,
            'apmOrderId' => $this->apmOrderId,
            'apmUserIdentity' => $this->apmUserIdentity,
            'additionalParams' => $this->additionalParams,
            'clientIp' => $this->clientIp,
            'items' => self::dehydrateList($this->items),
            'bankCode' => $this->bankCode,
            'cartItems' => self::dehydrateList($this->cartItems),
        ];
    }
}
