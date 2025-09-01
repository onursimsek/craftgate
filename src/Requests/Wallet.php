<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Requests\Wallet\Member;

final class Wallet extends AbstractRequestBridge
{
    #[AsDecorator]
    public function member(int $id)
    {
        return Container::pushOrGet(Member::class, $this, $id);
    }
}
