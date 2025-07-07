<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Proxies\InstallmentProxy;
use Psr\Http\Message\ResponseInterface;

/**
 * @mixin InstallmentProxy
 */
final class Installment extends RequestDecorator
{
    protected string $prefix = 'installment';

    public function search(float $price, array $params = []): ResponseInterface
    {
        return $this->withPath('installments')
            ->withQuery(['price' => $price] + $params)
            ->send();
    }

    public function bin(string $binNumber): ResponseInterface
    {
        return $this->withPath('bins', $binNumber)->send();
    }

    protected function proxy(): InstallmentProxy
    {
        return $this->proxy ??= new InstallmentProxy($this);
    }
}
