<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies\Wallet;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Wallet\Remittance;
use OnurSimsek\Craftgate\ValueObjects\Wallet\Remittance as RemittanceValueObject;
use Psr\Http\Message\ResponseInterface;

final class RemittanceProxy implements Proxy
{
    public function __construct(public readonly Remittance $decorator)
    {
    }

    public function sendRemittance(array $params): ResponseInterface
    {
        return $this->decorator->send(RemittanceValueObject::fromArray($params));
    }
}
