<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Onboarding;

use OnurSimsek\Craftgate\Enums\MemberType;
use OnurSimsek\Craftgate\ValueObjects\ValueObject;

abstract class CreateMember extends ValueObject implements Member
{
    public function __construct(
        public readonly string $memberExternalId,
        public readonly string $email,
        public readonly string $phoneNumber,
        public readonly string $address,
        public readonly bool $isBuyer,
        public readonly bool $isSubMerchant,
        public readonly ?MemberType $memberType = null,
        public readonly ?string $name = null,
        public readonly ?string $iban = null,
        public readonly ?string $legalCompanyTitle = null,
        public readonly ?string $taxOffice = null,
        public readonly ?string $taxNumber = null,
        public readonly ?string $contactName = null,
        public readonly ?string $contactSurname = null,
        public readonly ?int $subMerchantMaximumAllowedNegativeBalance = null,
        public readonly ?int $settlementDelayCount = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            memberExternalId: $params['memberExternalId'],
            email: $params['email'],
            phoneNumber: $params['phoneNumber'],
            address: $params['address'],
            isBuyer: $params['isBuyer'],
            isSubMerchant: $params['isSubMerchant'],
            memberType: self::hydrate($params['memberType'], MemberType::class),
            name: $params['name'] ?? null,
            iban: $params['iban'] ?? null,
            legalCompanyTitle: $params['legalCompanyTitle'] ?? null,
            taxOffice: $params['taxOffice'] ?? null,
            taxNumber: $params['taxNumber'] ?? null,
            contactName: $params['contactName'] ?? null,
            contactSurname: $params['contactSurname'] ?? null,
            subMerchantMaximumAllowedNegativeBalance: $params['settlementDelayCount'] ?? null,
            settlementDelayCount: $params['settlementDelayCount'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'isBuyer' => $this->isBuyer,
            'isSubMerchant' => $this->isSubMerchant,
            'memberType' => $this->memberType?->value,
            'memberExternalId' => $this->memberExternalId,
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'iban' => $this->iban,
            'phoneNumber' => $this->phoneNumber,
            'legalCompanyTitle' => $this->legalCompanyTitle,
            'taxOffice' => $this->taxOffice,
            'taxNumber' => $this->taxNumber,
            'contactName' => $this->contactName,
            'contactSurname' => $this->contactSurname,
            'subMerchantMaxAllowedNegativeBalance' => $this->subMerchantMaximumAllowedNegativeBalance,
            'settlementDelayCount' => $this->settlementDelayCount,
        ];
    }
}
