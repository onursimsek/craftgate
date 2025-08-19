<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\ApmPayment;
use OnurSimsek\Craftgate\ValueObjects\CreateApmPayment;
use Psr\Http\Message\ResponseInterface;

final class ApmPaymentProxy implements Proxy
{
    public function __construct(public readonly ApmPayment $decorator)
    {
    }

    public function createApmPayment(array $params): ResponseInterface
    {
        return $this->decorator->create(CreateApmPayment::fromArray($params));
    }
}
