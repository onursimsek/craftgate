<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\DirectApmType;
use OnurSimsek\Craftgate\Enums\PaymentGroup;

class CreateApmPayment extends BaseApmPayment
{
    public function __construct(
        float $price,
        float $paidPrice,
        array $items,
        DirectApmType $apmType,
        PaymentGroup $paymentGroup,
        Currency $currency = Currency::TL,
        ?string $paymentChannel = null,
        ?string $conversationId = null,
        ?string $externalId = null,
        ?int $buyerMemberId = null,
        ?string $apmOrderId = null,
        ?string $clientIp = null
    ) {
        parent::__construct($price, $paidPrice, $items, $apmType, $paymentGroup, $currency, $paymentChannel, $conversationId, $externalId, $buyerMemberId, $apmOrderId, $clientIp);
    }
}
