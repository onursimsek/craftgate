<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\Enums\PaymentMethod;
use OnurSimsek\Craftgate\Enums\PaymentPhase;
use OnurSimsek\Craftgate\ValueObjects\Components\FraudCheck;
use OnurSimsek\Craftgate\ValueObjects\Components\PaymentItem;

class CheckoutPayment extends ValueObject
{
    public function __construct(
        public readonly float $price,
        public readonly float $paidPrice,
        public readonly array $items,
        public readonly string $callbackUrl,
        public readonly Currency $currency = Currency::TL,
        public readonly ?string $conversationId = null,
        public readonly ?string $externalId = null,
        public readonly ?string $orderId = null,
        public readonly ?int $buyerMemberId = null,
        public readonly ?PaymentGroup $paymentGroup = null,
        public readonly ?PaymentPhase $paymentPhase = null,
        public readonly ?string $paymentChannel = null,
        public readonly ?string $cardUserKey = null,
        public readonly array $enabledInstallments = [],
        public readonly ?bool $allowOnlyCreditCard = null,
        public readonly ?bool $allowOnlyStoredCards = null,
        public readonly ?bool $alwaysStoreCardAfterPayment = null,
        public readonly ?bool $allowInstallmentOnlyCommercialCards = null,
        public readonly ?bool $forceAuthForNonCreditCards = null,
        public readonly ?bool $forceThreeDS = null,
        public readonly ?bool $depositPayment = null,
        public readonly ?int $ttl = null,
        public readonly ?string $masterpassGsmNumber = null,
        public readonly ?string $masterpassUserId = null,
        public readonly ?string $apmUserIdentity = null,
        /**
         * @var PaymentMethod[]
         */
        public readonly array $enabledPaymentMethods = [],
        public readonly ?array $cardBrandInstallments = [],
        public readonly ?FraudCheck $fraudParams = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            price: $params['price'],
            paidPrice: $params['paidPrice'],
            items: self::hydrate($params['items'], PaymentItem::class, true),
            callbackUrl: $params['callbackUrl'],
            currency: $params['currency'] ?? Currency::TL,
            conversationId: $params['conversationId'] ?? null,
            externalId: $params['externalId'] ?? null,
            orderId: $params['orderId'] ?? null,
            buyerMemberId: $params['buyerMemberId'] ?? null,
            paymentGroup: $params['paymentGroup'] ?? null,
            paymentPhase: $params['paymentPhase'] ?? null,
            paymentChannel: $params['paymentChannel'] ?? null,
            cardUserKey: $params['cardUserKey'] ?? null,
            enabledInstallments: $params['enabledInstallments'] ?? [],
            allowOnlyCreditCard: $params['allowOnlyCreditCard'] ?? null,
            allowOnlyStoredCards: $params['allowOnlyStoredCards'] ?? null,
            alwaysStoreCardAfterPayment: $params['alwaysStoreCardAfterPayment'],
            allowInstallmentOnlyCommercialCards: $params['allowInstallmentOnlyCommercialCards'],
            forceAuthForNonCreditCards: $params['forceAuthForNonCreditCards'],
            forceThreeDS: $params['forceThreeDS'],
            depositPayment: $params['depositPayment'],
            ttl: $params['ttl'],
            masterpassGsmNumber: $params['masterpassGsmNumber'],
            masterpassUserId: $params['masterpassUserId'],
            apmUserIdentity: $params['apmUserIdentity'],
            enabledPaymentMethods: $params['enabledPaymentMethods'] ?? [],
            cardBrandInstallments: $params['cardBrandInstallments'],
            fraudParams: self::hydrate($params['fraudParams'] ?? null, FraudCheck::class),
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'paidPrice' => $this->paidPrice,
            'items' => self::dehydrateList($this->items),
            'callbackUrl' => $this->callbackUrl,
            'currency' => $this->currency->value,
            'conversationId' => $this->conversationId,
            'externalId' => $this->externalId,
            'orderId' => $this->orderId,
            'buyerMemberId' => $this->buyerMemberId,
            'paymentGroup' => $this->paymentGroup?->value,
            'paymentPhase' => $this->paymentPhase?->value,
            'paymentChannel' => $this->paymentChannel,
            'cardUserKey' => $this->cardUserKey,
            'enabledInstallments' => $this->enabledInstallments,
            'allowOnlyCreditCard' => $this->allowOnlyCreditCard,
            'allowOnlyStoredCards' => $this->allowOnlyStoredCards,
            'alwaysStoreCardAfterPayment' => $this->alwaysStoreCardAfterPayment,
            'allowInstallmentOnlyCommercialCards' => $this->allowInstallmentOnlyCommercialCards,
            'forceAuthForNonCreditCards' => $this->forceAuthForNonCreditCards,
            'forceThreeDS' => $this->forceThreeDS,
            'depositPayment' => $this->depositPayment,
            'ttl' => $this->ttl,
            'masterpassGsmNumber' => $this->masterpassGsmNumber,
            'masterpassUserId' => $this->masterpassUserId,
            'apmUserIdentity' => $this->apmUserIdentity,
            'enabledPaymentMethods' => $this->enabledPaymentMethods,
            'cardBrandInstallments' => $this->cardBrandInstallments,
            'fraudParams' => $this->fraudParams?->toArray(),
        ];
    }
}
