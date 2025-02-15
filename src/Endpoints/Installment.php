<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Endpoints;

use Psr\Http\Message\ResponseInterface;

final class Installment extends RequestDecorator
{
    protected string $baseUrl = 'installment';

    public function searchInstallments(array $params = []): ResponseInterface
    {
        return $this->withUri(
            $this->psrRequest()->getUri()
                ->withPath($this->generatePath('installments'))
                ->withQuery(http_build_query($params))
        )->send();
    }

    public function retrieveBinNumber(string $binNumber): ResponseInterface
    {
        return $this->withUri(
            $this->psrRequest()->getUri()
                ->withPath($this->generatePath(sprintf('bins/%s', $binNumber)))
        )->send();
    }
}
