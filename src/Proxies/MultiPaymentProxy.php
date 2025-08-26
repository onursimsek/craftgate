<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\MultiPayment;
use Psr\Http\Message\ResponseInterface;

final class MultiPaymentProxy implements Proxy
{
    public function __construct(public readonly MultiPayment $decorator)
    {
    }

    public function retrieveMultiPayment(string $token): ResponseInterface
    {
        return $this->decorator->fetch($token);
    }
}
