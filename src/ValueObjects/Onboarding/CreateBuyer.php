<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Onboarding;

use OnurSimsek\Craftgate\Enums\MemberType;

class CreateBuyer extends CreateMember
{
    public function __construct(
        string $memberExternalId,
        string $email,
        string $phoneNumber,
        string $address,
        ?MemberType $memberType = null,
        ?string $name = null,
        ?string $iban = null,
        ?string $legalCompanyTitle = null,
        ?string $taxOffice = null,
        ?string $taxNumber = null,
        ?string $contactName = null,
        ?string $contactSurname = null,
        ?int $subMerchantMaximumAllowedNegativeBalance = null,
        ?int $settlementDelayCount = null
    ) {
        parent::__construct($memberExternalId, $email, $phoneNumber, $address, true, false, $memberType, $name, $iban, $legalCompanyTitle, $taxOffice, $taxNumber, $contactName, $contactSurname, $subMerchantMaximumAllowedNegativeBalance, $settlementDelayCount);
    }

    public static function fromArray(array $params): static
    {
        return parent::fromArray(['isBuyer' => true, 'isSubMerchant' => false] + $params);
    }
}
