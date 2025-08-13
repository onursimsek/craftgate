<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\ForwardCallsToDecorator;
use OnurSimsek\Craftgate\Contracts\RequestBridge;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use WeakMap;

abstract class AbstractRequestBridge implements RequestBridge
{
    use ForwardCallsToDecorator;

    /**
     * @param  RequestInterface&BaseRequest  $request
     */
    public function __construct(protected readonly RequestInterface $request)
    {
        $this->decoratorMap = new WeakMap();
    }
}
