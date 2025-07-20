<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\ForwardCallsToDecorator;
use OnurSimsek\Craftgate\Proxies\CardPaymentProxy;
use OnurSimsek\Craftgate\Proxies\CheckoutPaymentProxy;
use OnurSimsek\Craftgate\Proxies\DepositProxy;
use OnurSimsek\Craftgate\Requests\Payments\CardPayment;
use OnurSimsek\Craftgate\Requests\Payments\CheckoutPayment;
use OnurSimsek\Craftgate\Requests\Payments\Deposit;

/**
 * @mixin CardPaymentProxy
 * @mixin CheckoutPaymentProxy
 * @mixin DepositProxy
 */
final class Payment extends AbstractRequestBridge
{
    use ForwardCallsToDecorator;

    private CardPayment $cardPayment;

    private CheckoutPayment $checkoutPayment;

    private Deposit $deposit;

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

    #[AsDecorator]
    public function deposit(): Deposit
    {
        return $this->deposit ??= new Deposit($this->request);
    }
}
