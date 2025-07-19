<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

class AdditionalParams extends ValueObject
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
