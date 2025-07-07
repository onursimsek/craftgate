<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Contracts;

interface Arrayable
{
    public static function fromArray(array $params): static;

    public function toArray(): array;
}
