<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Concerns;

use BadMethodCallException;
use WeakMap;

trait ForwardCallsToDecorator
{
    protected WeakMap $decoratorMap;

    public function __call(string $name, array $arguments)
    {
        if (! $this->decoratorMap->count()) {
            $this->fillDecoratorMap();
        }

        foreach ($this->decoratorMap as $decorator => $methods) {
            if (! in_array($name, $methods, true)) {
                throw new BadMethodCallException('Call to undefined method ' . static::class . '::' . $name . '()');
            }

            return $decorator->{$name}(...$arguments);
        }

        return true;
    }

    private function fillDecoratorMap(): void
    {
        $reflection = new ReflectionClass($this);
        foreach ($reflection->findDecoratorMethods() as $method) {
            $this->decoratorMap[$this->{$method->getName()}()] = iterator_to_array($reflection->getProxyMethodsFromDecorator($method));
        }
    }
}
