<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Onboarding;

use OnurSimsek\Craftgate\Enums\MemberType;
use OnurSimsek\Craftgate\ValueObjects\ValueObject;

class SearchMember extends ValueObject
{
    public function __construct(
        public readonly ?bool $isBuyer = null,
        public readonly ?bool $isSubMerchant = null,
        public readonly ?MemberType $memberType = null,
        public readonly ?string $memberExternalId = null,
        public readonly ?array $memberIds = [],
        public readonly ?string $name = null,
        public readonly ?int $page = null,
        public readonly ?int $size = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            isBuyer: $params['isBuyer'] ?? false,
            isSubMerchant: $params['isSubMerchant'] ?? false,
            memberType: $params['memberType'] ?? null,
            memberExternalId: $params['memberExternalId'] ?? null,
            memberIds: $params['memberIds'] ?? [],
            name: $params['name'] ?? null,
            page: $params['page'] ?? null,
            size: $params['size'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'isBuyer' => $this->isBuyer,
            'isSubMerchant' => $this->isSubMerchant,
            'memberType' => $this->memberType?->value,
            'memberExternalId' => $this->memberExternalId,
            'memberIds' => $this->memberIds,
            'name' => $this->name,
            'page' => $this->page,
            'size' => $this->size,
        ];
    }
}
