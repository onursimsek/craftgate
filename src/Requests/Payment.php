<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Proxies\{ApmPaymentProxy,
    CardLoyaltyProxy,
    CardPaymentProxy,
    CheckoutPaymentProxy,
    DepositProxy,
    GarantiPayProxy,
    PosApmPaymentProxy,
    RefundTransactionProxy};
use OnurSimsek\Craftgate\Requests\Payments\{ApmPayment,
    CardLoyalty,
    CardPayment,
    CheckoutPayment,
    Deposit,
    GarantiPay,
    PosApmPayment,
    RefundTransaction};

/**
 * @mixin CardPaymentProxy
 * @mixin CheckoutPaymentProxy
 * @mixin DepositProxy
 * @mixin GarantiPayProxy
 * @mixin ApmPaymentProxy
 * @mixin PosApmPaymentProxy
 * @mixin CardLoyaltyProxy
 * @mixin RefundTransactionProxy
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

    #[AsDecorator]
    public function apmPayment(): ApmPayment
    {
        return Container::pushOrGet(ApmPayment::class, $this->request);
    }

    #[AsDecorator]
    public function posApmPayment(): PosApmPayment
    {
        return Container::pushOrGet(PosApmPayment::class, $this->request);
    }

    #[AsDecorator]
    public function cardLoyalty()
    {
        return Container::pushOrGet(CardLoyalty::class, $this->request);
    }

    #[AsDecorator]
    public function refundTransaction()
    {
        return Container::pushOrGet(RefundTransaction::class, $this->request);
    }
}
