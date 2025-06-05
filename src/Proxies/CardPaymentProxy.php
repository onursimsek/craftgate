<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\CardPayment;
use OnurSimsek\Craftgate\ValueObjects\Payment;
use Psr\Http\Message\ResponseInterface;

class CardPaymentProxy implements Proxy
{
    public function __construct(public readonly CardPayment $cardPayment)
    {
    }

    public function createPayment(array $request): ResponseInterface
    {
        return $this->cardPayment->create(Payment::fromArray($request));
    }

    public function retrievePayment($paymentId): ResponseInterface
    {
        return $this->cardPayment->fetch($paymentId);
        /*$path = "/payment/v1/card-payments/" . $paymentId;
        return $this->httpGet($path);*/
    }

    public function postAuthPayment($paymentId, array $request): ResponseInterface
    {
        return $this->cardPayment->postAuth($paymentId, $request);
        /*$path = "/payment/v1/card-payments/" . $paymentId . "/post-auth";
        return $this->httpPost($path, $request);*/
    }

    public function init3DSPayment(array $request): ResponseInterface
    {
        return $this->cardPayment->initThreeDSecure($request);
        /*$path = "/payment/v1/card-payments/3ds-init";
        return $this->httpPost($path, $request);*/
    }

    public function complete3DSPayment(array $request): ResponseInterface
    {
        return $this->cardPayment->completeThreeDSecure($request);
        /*$path = "/payment/v1/card-payments/3ds-complete";
        return $this->httpPost($path, $request);*/
    }
}
