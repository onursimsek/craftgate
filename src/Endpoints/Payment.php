<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Endpoints;

use Psr\Http\Message\ResponseInterface;

class Payment extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function createPayment(array $params): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('card-payments')
            ->withBody($params)
            ->send();
    }

    public function retrievePayment(int $id): ResponseInterface
    {
        return $this->withPath('card-payments', $id)->send();
    }

    public function postAuthPayment(int $id, array $params): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('card-payments', $id, 'post-auth')
            ->withBody($params)
            ->send();
    }

    public function init3DSPayment(array $param): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('card-payments', '3ds-init')
            ->withBody($param)
            ->send();
    }

    public function complete3DSPayment(array $param): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('card-payments', '3ds-complete')
            ->withBody($param)
            ->send();
    }

    public function initCheckoutPayment(array $param): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('checkout-payments', 'init')
            ->withBody($param)
            ->send();
    }

    public function retrieveCheckoutPayment(string $token): ResponseInterface
    {
        return $this->withMethod('get')
            ->withPath('checkout-payments', $token)
            ->send();
    }
}
