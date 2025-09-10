<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Requests\Wallet\Member;
use OnurSimsek\Craftgate\Requests\Wallet\Remittance;

final class Wallet extends AbstractRequestBridge
{
    #[AsDecorator]
    public function member(int $id)
    {
        return Container::pushOrGet(Member::class, $this, $id);
    }

    #[AsDecorator]
    public function remittance()
    {
        return Container::pushOrGet(Remittance::class, $this);
    }
}
