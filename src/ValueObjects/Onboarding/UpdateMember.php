<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Onboarding;

use OnurSimsek\Craftgate\Enums\MemberType;
use OnurSimsek\Craftgate\ValueObjects\ValueObject;

class UpdateMember extends ValueObject implements Member
{
    public function __construct(
        public readonly string $email,
        public readonly string $address,
        public readonly ?bool $isBuyer = null,
        public readonly ?bool $isSubMerchant = null,
        public readonly ?MemberType $memberType = null,
        public readonly ?string $name = null,
        public readonly ?string $phoneNumber = null,
        public readonly ?string $contactName = null,
        public readonly ?string $contactSurname = null,
        public readonly ?string $legalCompanyTitle = null,
        public readonly ?string $taxOffice = null,
        public readonly ?string $taxNumber = null,
        public readonly ?string $iban = null,
        public readonly ?int $subMerchantMaximumAllowedNegativeBalance = null,
        public readonly ?int $settlementDelayCount = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new static(
            email: $params['email'],
            address: $params['address'],
            isBuyer: $params['isBuyer'],
            isSubMerchant: $params['isSubMerchant'],
            memberType: self::hydrate($params['memberType'], MemberType::class),
            name: $params['name'] ?? null,
            phoneNumber: $params['phoneNumber'],
            contactName: $params['contactName'] ?? null,
            contactSurname: $params['contactSurname'] ?? null,
            legalCompanyTitle: $params['legalCompanyTitle'] ?? null,
            taxOffice: $params['taxOffice'] ?? null,
            taxNumber: $params['taxNumber'] ?? null,
            iban: $params['iban'] ?? null,
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
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'contactName' => $this->contactName,
            'contactSurname' => $this->contactSurname,
            'legalCompanyTitle' => $this->legalCompanyTitle,
            'taxOffice' => $this->taxOffice,
            'iban' => $this->iban,
            'taxNumber' => $this->taxNumber,
            'subMerchantMaxAllowedNegativeBalance' => $this->subMerchantMaximumAllowedNegativeBalance,
            'settlementDelayCount' => $this->settlementDelayCount,
        ];
    }
}
