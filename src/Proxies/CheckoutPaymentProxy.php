<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\CheckoutPayment;
use OnurSimsek\Craftgate\ValueObjects\CheckoutPayment as CheckoutPaymentValueObject;
use Psr\Http\Message\ResponseInterface;

final class CheckoutPaymentProxy implements Proxy
{
    public function __construct(public readonly CheckoutPayment $checkoutPayment)
    {
    }

    public function initCheckoutPayment(array $request): ResponseInterface
    {
        return $this->checkoutPayment->init(CheckoutPaymentValueObject::fromArray($request));
    }

    public function retrieveCheckoutPayment(string $token): ResponseInterface
    {
        return $this->checkoutPayment->fetch($token);
    }

    public function expireCheckoutPayment(string $token): ResponseInterface
    {
        return $this->checkoutPayment->expire($token);
    }
}
