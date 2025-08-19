<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use BackedEnum;
use OnurSimsek\Craftgate\Contracts\Arrayable;

abstract class ValueObject implements Arrayable
{
    /**
     * @param class-string<Arrayable|BackedEnum>|array|null|BackedEnum $value
     * @param class-string<Arrayable|BackedEnum> $cast
     * @param bool $list
     * @return Arrayable|BackedEnum|array|null
     */
    protected static function hydrate(mixed $value, string $cast, bool $list = false): Arrayable|BackedEnum|array|null
    {
        if (is_null($value)) {
            return null;
        }

        if ($value instanceof $cast) {
            return $value;
        }

        if ($list) {
            return self::hydrateList($value, $cast);
        }

        if (enum_exists($cast)) {
            return $cast::tryFrom($value);
        }

        if (class_exists($cast)) {
            return $cast::fromArray($value);
        }

        return null;
    }

    private static function hydrateList(mixed $value, string $cast): array
    {
        return array_map(fn ($item) => self::hydrate($item, $cast), $value);
    }

    protected function dehydrateList(?array $value): ?array
    {
        if (is_null($value)) {
            return null;
        }

        return array_map(fn (Arrayable $item) => $item->toArray(), $value);
    }
}
