<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Contracts\Arrayable;

class AdditionalParams implements Arrayable
{
    public function __construct(public readonly string $msisdn)
    {
    }

    public static function fromArray(array $params): static
    {
        return new self($params['msisdn']);
    }

    public function toArray(): array
    {
        return [
            'msisdn' => $this->msisdn,
        ];
    }
}
