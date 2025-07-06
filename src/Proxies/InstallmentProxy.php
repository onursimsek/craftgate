<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Installment;
use Psr\Http\Message\ResponseInterface;

class InstallmentProxy implements Proxy
{
    public function __construct(public readonly Installment $installment) {}

    public function searchInstallments(array $params = []): ResponseInterface
    {
        $price = $params['price'];
        unset($params['price']);

        return $this->installment->search($price, $params);
    }

    public function retrieveBinNumber(string $binNumber): ResponseInterface
    {
        return $this->installment->bin($binNumber);
    }
}
