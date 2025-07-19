<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\ForwardCallsToDecorator;
use OnurSimsek\Craftgate\Proxies\CardPaymentProxy;
use OnurSimsek\Craftgate\Requests\Payments\CardPayment;
use OnurSimsek\Craftgate\Requests\Payments\CheckoutPayment;

/**
 * @mixin CardPaymentProxy
 */
final class Payment extends AbstractRequestBridge
{
    use ForwardCallsToDecorator;

    private CardPayment $cardPayment;

    private CheckoutPayment $checkoutPayment;

    #[AsDecorator]
    public function cardPayment(): CardPayment
    {
        return $this->cardPayment ??= new CardPayment($this->request);
    }

    #[AsDecorator]
    public function checkoutPayment(): CheckoutPayment
    {
        return $this->checkoutPayment ??= new CheckoutPayment($this->request);
    }
}
