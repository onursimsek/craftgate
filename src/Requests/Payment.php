<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Proxies\CardPaymentProxy;
use OnurSimsek\Craftgate\Proxies\CheckoutPaymentProxy;
use OnurSimsek\Craftgate\Proxies\DepositProxy;
use OnurSimsek\Craftgate\Proxies\GarantiPayProxy;
use OnurSimsek\Craftgate\Requests\Payments\CardPayment;
use OnurSimsek\Craftgate\Requests\Payments\CheckoutPayment;
use OnurSimsek\Craftgate\Requests\Payments\Deposit;
use OnurSimsek\Craftgate\Requests\Payments\GarantiPay;

/**
 * @mixin CardPaymentProxy
 * @mixin CheckoutPaymentProxy
 * @mixin DepositProxy
 * @mixin GarantiPayProxy
 */
final class Payment extends AbstractRequestBridge
{
    #[AsDecorator]
    public function cardPayment(): CardPayment
    {
        return Container::pushOrGet(CardPayment::class, $this->request);
    }

    #[AsDecorator]
    public function checkoutPayment(): CheckoutPayment
    {
        return Container::pushOrGet(CheckoutPayment::class, $this->request);
    }

    #[AsDecorator]
    public function deposit(): Deposit
    {
        return Container::pushOrGet(Deposit::class, $this->request);
    }

    #[AsDecorator]
    public function garantiPay(): GarantiPay
    {
        return Container::pushOrGet(GarantiPay::class, $this->request);
    }
}
