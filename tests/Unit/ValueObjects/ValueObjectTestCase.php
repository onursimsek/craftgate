<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\ValueObjects;

use BackedEnum;
use OnurSimsek\Craftgate\Contracts\Arrayable;
use OnurSimsek\Craftgate\Tests\TestCase;
use OnurSimsek\Craftgate\ValueObjects\ValueObject;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

abstract class ValueObjectTestCase extends TestCase
{
    abstract public static function provider(): array;

    abstract public static function rawArrayProvider(): array;

    #[Test]
    #[DataProvider('provider')]
    public function it_should_be_initialized(string $valueObjectClass, array $params)
    {
        $valueObject = new $valueObjectClass(...$params);

        foreach ($params as $property => $value) {
            $this->assertEquals($value, $valueObject->$property);
        }
    }

    /**
     * @param class-string<Arrayable> $valueObjectClass
     * @param array $params
     * @return void
     */
    #[Test]
    #[DataProvider('provider')]
    public function it_should_be_initialized_from_array(string $valueObjectClass, array $params)
    {
        $valueObject = $valueObjectClass::fromArray($params);

        foreach ($params as $property => $value) {
            match ($value) {
                $value instanceof BackedEnum => $this->assertEquals($value->value, $valueObject->$property),
                $value instanceof Arrayable => $this->assertEquals($value->toArray(), $valueObject->$property),
                default => $this->assertEquals($value, $valueObject->$property),
            };
        }
    }

    /**
     * @param class-string<ValueObject> $valueObjectClass
     * @param array $params
     * @param array $defaults
     * @return void
     */
    #[Test]
    #[DataProvider('provider')]
    #[DataProvider('rawArrayProvider')]
    public function it_should_be_convertable_to_array(string $valueObjectClass, array $params, array $defaults = [])
    {
        $valueObject = $valueObjectClass::fromArray($params);

        $expected = $this->generateExpected(array_replace_recursive($params, $defaults));

        $actual = $valueObject->toArray();

        ksort($expected);
        ksort($actual);

        $this->assertEquals($expected, $actual);
    }

    private function generateExpected(array $params)
    {
        return array_map(function ($value) {
            return match (true) {
                $value instanceof BackedEnum => $value->value,
                $value instanceof Arrayable => $value->toArray(),
                is_array($value) => $this->generateExpected($value),
                default => $value,
            };
        }, $params);
    }

    protected static function mock(string $originalClassName): object
    {
        // getMockBuilder cannot call statically
        $class = (new class ($originalClassName) extends TestCase {
        });

        $mock = $class->getMockBuilder($originalClassName)->disableOriginalConstructor()->getMock();
        $mock->method('toArray')->willReturn([]);

        return $mock;
    }
}
