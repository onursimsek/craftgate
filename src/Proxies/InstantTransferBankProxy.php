<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Payments\InstantTransferBank;
use Psr\Http\Message\ResponseInterface;

final class InstantTransferBankProxy implements Proxy
{
    public function __construct(public readonly InstantTransferBank $decorator)
    {
    }

    public function retrieveActiveBanks(): ResponseInterface
    {
        return $this->decorator->fetch();
    }
}
