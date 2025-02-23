<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Contracts\Arrayable;

class FraudCheck implements Arrayable
{
    /**
     * @param string $buyerExternalId Alıcıya özel üretilmiş unique değer
     * @param string $buyerPhoneNumber Alıcının telefon numarası
     * @param string $buyerEmail Alıcının email adresi
     * @param string $customerFraudVariable Özel değişken
     */
    public function __construct(
        public readonly string $buyerExternalId,
        public readonly string $buyerPhoneNumber,
        public readonly string $buyerEmail,
        public readonly string $customerFraudVariable
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            buyerExternalId: $params['buyerExternalId'],
            buyerPhoneNumber: $params['buyerPhoneNumber'],
            buyerEmail: $params['buyerEmail'],
            customerFraudVariable: $params['customerFraudVariable']
        );
    }

    public function toArray(): array
    {
        return [
            'buyerExternalId' => $this->buyerExternalId,
            'buyerPhoneNumber' => $this->buyerPhoneNumber,
            'buyerEmail' => $this->buyerEmail,
            'customerFraudVariable' => $this->customerFraudVariable
        ];
    }
}
