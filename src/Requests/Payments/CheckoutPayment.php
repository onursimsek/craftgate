<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Endpoints\RequestDecorator;
use Psr\Http\Message\ResponseInterface;

final class CheckoutPayment extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function init(array $param): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('checkout-payments', 'init')
            ->withBody($param)
            ->send();
    }

    public function fetch(string $token): ResponseInterface
    {
        return $this->withMethod('get')
            ->withPath('checkout-payments', $token)
            ->send();
    }

    public function expire(string $token): ResponseInterface
    {
        return $this->withMethod('delete')
            ->withPath('checkout-payments', $token)
            ->send();
    }
}
