<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects\Components;

use Generator;
use SplMinHeap;

final class Installments extends SplMinHeap
{
    public function __construct(array $installments = [])
    {
        foreach ($installments as $installment) {
            $this->push($installment);
        }
    }

    public function push(Installment $installment): void
    {
        $this->insert([$installment->number, $installment]);
    }

    public static function fromArray(array $installments): Installments
    {
        return new self(array_map(fn (array $installment) => Installment::fromArray($installment), $installments));
    }

    public function toArray(): array
    {
        return iterator_to_array($this->iterate());
    }

    private function iterate(): Generator
    {
        /** @var Installment $installment */
        foreach ($this as [, $installment]) {
            yield $installment->toArray();
        }
    }
}
