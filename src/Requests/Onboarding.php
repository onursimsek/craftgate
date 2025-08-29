<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Requests\Onboarding\Member;

final class Onboarding extends AbstractRequestBridge
{
    #[AsDecorator]
    public function member()
    {
        return Container::pushOrGet(Member::class, $this);
    }
}
