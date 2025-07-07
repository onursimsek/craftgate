<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Concerns;

use BadMethodCallException;
use OnurSimsek\Craftgate\Contracts\Proxy;

trait ForwardCallsToProxy
{
    protected Proxy $proxy;

    public function __call(string $name, array $arguments)
    {
        $this->proxy();
        if (! method_exists($this->proxy, $name)) {
            throw new BadMethodCallException('Call to undefined method ' . static::class . '::' . $name . '()');
        }

        return $this->proxy->{$name}(...$arguments);
    }
}
