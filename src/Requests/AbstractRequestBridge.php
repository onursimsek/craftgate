<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Contracts\RequestBridge;
use OnurSimsek\Craftgate\Contracts\RequestInterface;

abstract class AbstractRequestBridge implements RequestBridge
{
    /**
     * @param RequestInterface&BaseRequest $request
     */
    public function __construct(protected readonly RequestInterface $request)
    {
    }
}
