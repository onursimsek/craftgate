<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Endpoints;

use Psr\Http\Message\ResponseInterface;

final class Installment extends RequestDecorator
{
    protected string $prefix = 'installment';

    public function searchInstallments(array $params = []): ResponseInterface
    {
        return $this->withPath('installments')
            ->withQuery($params)
            ->send();
    }

    public function retrieveBinNumber(string $binNumber): ResponseInterface
    {
        return $this->withPath('bins', $binNumber)->send();
    }
}
