<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\ForwardCallsToDecorator;
use OnurSimsek\Craftgate\Proxies\CardPaymentProxy;
use OnurSimsek\Craftgate\Requests\Payments\CardPayment;

/**
 * @mixin CardPaymentProxy
 */
final class Payment extends AbstractRequestBridge
{
    use ForwardCallsToDecorator;

    private CardPayment $cardPayment;

    #[AsDecorator]
    public function cardPayment(): CardPayment
    {
        return $this->cardPayment ??= new CardPayment($this->request);
    }
}
