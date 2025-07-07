<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Concerns;

use Generator;
use OnurSimsek\Craftgate\Contracts\RequestBridge;
use OnurSimsek\Craftgate\Requests\AsDecorator;
use ReflectionMethod;

final class ReflectionClass extends \ReflectionClass
{
    private const PROXY_NAMESPACE = 'OnurSimsek\\Craftgate\\Proxies\\';

    public function __construct(private readonly RequestBridge $bridge)
    {
        parent::__construct($this->bridge);
    }

    /**
     * @return ReflectionMethod[]
     */
    public function findDecoratorMethods(): array
    {
        $methods = [];
        foreach ($this->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if (! $method->getAttributes(AsDecorator::class)) {
                continue;
            }

            $methods[] = $method;
        }

        return $methods;
    }

    public function getProxyMethodsFromDecorator(ReflectionMethod $method): Generator
    {
        $className = $this->classBaseName($this->bridge->{$method->getName()}());

        $proxy = $this->proxyClassReflection($className);
        foreach ($proxy->getMethods(ReflectionMethod::IS_PUBLIC) as $proxyMethod) {
            if (str_starts_with($proxyMethod->getName(), '__')) {
                continue;
            }
            yield $proxyMethod->getName();
        }
    }

    private function classBaseName(object $object): string
    {
        $class = explode('\\', get_class($object));

        return end($class);
    }

    private function proxyClassReflection(string $decorator): \ReflectionClass
    {
        return new \ReflectionClass(sprintf('%s%sProxy', self::PROXY_NAMESPACE, $decorator));
    }
}
