<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Requests\Payments\CardPayment;

final class Payment extends RequestDecorator
{
    private CardPayment $cardPayment;

    /**
     * TODO: Payment class'i bir bridge oldugu icin proxy mantiginda sorun oldu
     * proxy method'unun burada olmasi gerekiyordu ama alt class'larda
     *
     * Bu gibi class'lari RequestDecorator yerine RequestBridge olarak kullanmak bir yontem olabilir.
     */

    public function cardPayment(): CardPayment
    {
        return $this->cardPayment ??= new CardPayment($this->request);
    }
}
