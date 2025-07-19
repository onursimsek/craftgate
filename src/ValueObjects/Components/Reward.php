<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Components;

use OnurSimsek\Craftgate\ValueObjects\ValueObject;

class Reward extends ValueObject
{
    /**
     * @param float $cardRewardMoney Müşterinin kartına tanımlı genel kullanım amaçlı puandan kullanılacak tutar.
     * @param float $firmRewardMoney Müşterinin ilgili üye işyerine özel olarak tanımlanmış puandan kullanılacak tutar.
     */
    public function __construct(public readonly float $cardRewardMoney, public readonly float $firmRewardMoney)
    {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            cardRewardMoney: (float)$params['cardRewardMoney'],
            firmRewardMoney: (float)$params['firmRewardMoney']
        );
    }

    public function toArray(): array
    {
        return [
            'cardRewardMoney' => $this->cardRewardMoney,
            'firmRewardMoney' => $this->firmRewardMoney,
        ];
    }
}
