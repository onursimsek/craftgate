<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Payments;

use OnurSimsek\Craftgate\Endpoints\RequestDecorator;
use Psr\Http\Message\ResponseInterface;

class Deposit extends RequestDecorator
{
    protected string $prefix = 'payment';

    public function create(array $params): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('deposits')
            ->withBody($params)
            ->send();
    }

    public function initThreeDSecure(array $params): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('deposits', '3ds-init')
            ->withBody($params)
            ->send();
    }

    public function completeThreeDSecure(array $params): ResponseInterface
    {
        return $this->withMethod('post')
            ->withPath('deposits', '3ds-complete')
            ->withBody($params)
            ->send();
    }
}
