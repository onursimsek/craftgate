<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Contracts\Arrayable;

class PaymentItem implements Arrayable
{
    /**
     * @param float $price İlgili ürün ya da hizmetin sepet tutarı
     * @param string|null $name Ödemeye ilişkin ürün ya da hizmetin adı
     * @param string|null $externalId İlgili ürün ya da hizmeti ifade eden dış ID değeri. Genellikle üye işyeri sisteminde bu kırılıma ilişkin ID değeri kullanılır
     * @param int|null $subMerchantMemberId Ürün ya da hizmeti sağlayan satıcı ID'si
     * @param float|null $subMerchantMemberPrice Ödemeden satıcıya aktarılacak tutar. subMerchantMemberId alanı doluysa gönderilmesi gerekmektedir
     */
    public function __construct(
        public readonly float $price,
        public readonly ?string $name = null,
        public readonly ?string $externalId = null,
        public readonly ?int $subMerchantMemberId = null,
        public readonly ?float $subMerchantMemberPrice = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            price: $params['price'],
            name: $params['name'] ?? null,
            externalId: $params['externalId'] ?? null,
            subMerchantMemberId: $params['subMerchantMemberId'] ?? null,
            subMerchantMemberPrice: $params['subMerchantMemberPrice'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'name' => $this->name,
            'externalId' => $this->externalId,
            'subMerchantMemberId' => $this->subMerchantMemberId,
            'subMerchantMemberPrice' => $this->subMerchantMemberPrice,
        ];
    }
}
