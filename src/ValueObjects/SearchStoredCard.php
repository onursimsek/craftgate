<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\CardAssociation;
use OnurSimsek\Craftgate\Enums\CardExpiryStatus;
use OnurSimsek\Craftgate\Enums\CardType;

class SearchStoredCard extends ValueObject
{
    public function __construct(
        public readonly ?string $cardAlias = null,
        public readonly ?string $cardBrand = null,
        public readonly ?CardType $cardType = null,
        public readonly ?string $cardUserKey = null,
        public readonly ?string $cardToken = null,
        public readonly ?string $cardBankName = null,
        public readonly ?CardAssociation $cardAssociation = null,
        public readonly ?CardExpiryStatus $cardExpiryStatus = null,
        public readonly ?string $minCreatedDate = null,
        public readonly ?string $maxCreatedDate = null,
        public readonly ?int $page = null,
        public readonly ?int $size = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            cardAlias: $params['cardAlias'] ?? null,
            cardBrand: $params['cardBrand'] ?? null,
            cardType: $params['cardType'] ?? null,
            cardUserKey: $params['cardUserKey'] ?? null,
            cardToken: $params['cardToken'] ?? null,
            cardBankName: $params['cardBankName'] ?? null,
            cardAssociation: self::hydrate($params['cardAssociation'] ?? null, CardAssociation::class),
            cardExpiryStatus: self::hydrate($params['cardExpiryStatus'] ?? null, CardExpiryStatus::class),
            minCreatedDate: $params['minCreatedDate'] ?? null,
            maxCreatedDate: $params['maxCreatedDate'] ?? null,
            page: $params['page'] ?? null,
            size: $params['size'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'cardAlias' => $this->cardAlias,
            'cardBrand' => $this->cardBrand,
            'cardType' => $this->cardType,
            'cardUserKey' => $this->cardUserKey,
            'cardToken' => $this->cardToken,
            'cardBankName' => $this->cardBankName,
            'cardAssociation' => $this->cardAssociation?->value,
            'cardExpiryStatus' => $this->cardExpiryStatus?->value,
            'minCreatedDate' => $this->minCreatedDate,
            'maxCreatedDate' => $this->maxCreatedDate,
            'page' => $this->page,
            'size' => $this->size,
        ];
    }
}
