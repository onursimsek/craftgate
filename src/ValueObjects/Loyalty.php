<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Contracts\Arrayable;
use OnurSimsek\Craftgate\Enums\LoyaltyType;

class Loyalty implements Arrayable
{
    /**
     * @param LoyaltyType $type Banka tarafından sağlanan ödüllerin tipini belirtir
     * @param Reward|null $reward Yalnızca puan tipinde kullanılan ödül bilgisi
     */
    public function __construct(public readonly LoyaltyType $type, public readonly ?Reward $reward = null)
    {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            type: $params['type'],
            reward: $params['reward'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'reward' => $this->reward?->toArray(),
        ];
    }
}
