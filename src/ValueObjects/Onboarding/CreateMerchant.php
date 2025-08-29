<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Onboarding;

use OnurSimsek\Craftgate\Enums\MemberType;

class CreateMerchant extends CreateMember
{
    public function __construct(
        string $memberExternalId,
        string $email,
        string $phoneNumber,
        string $address,
        string $name,
        MemberType $memberType,
        string $iban,
        string $legalCompanyTitle,
        string $taxOffice,
        string $taxNumber,
        ?string $contactName = null,
        ?string $contactSurname = null,
        ?int $subMerchantMaximumAllowedNegativeBalance = null,
        ?int $settlementDelayCount = null
    ) {
        parent::__construct($memberExternalId, $email, $phoneNumber, $address, false, true, $memberType, $name, $iban, $legalCompanyTitle, $taxOffice, $taxNumber, $contactName, $contactSurname, $subMerchantMaximumAllowedNegativeBalance, $settlementDelayCount);
    }

    public static function fromArray(array $params): static
    {
        return parent::fromArray(['isBuyer' => false, 'isSubMerchant' => true] + $params);
    }
}
