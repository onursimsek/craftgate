<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Endpoints;

use Psr\Http\Message\ResponseInterface;

class Payment extends RequestDecorator
{
    protected string $baseUrl = 'payment';

    public function createPayment(array $params): ResponseInterface
    {
        return $this->withMethod('post')
            ->withBody($params)
            ->withUri(
                $this->psrRequest()->getUri()
                    ->withPath($this->generatePath('card-payments'))
            )
            ->send();
    }
}
