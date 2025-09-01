<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies\Wallet;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Requests\Wallet\Member;
use Psr\Http\Message\ResponseInterface;

final class MemberProxy implements Proxy
{
    public function __construct(public readonly Member $decorator)
    {
    }

    public function createMemberWallet(int $memberId, array $params = []): ResponseInterface
    {
        return $this->decorator->setId($memberId)
            ->createWallet(
                $params['negativeAmountLimit'] ?? null,
                Currency::tryFrom($params['currency'] ?? null)
            );
    }

    public function retrieveMemberWallet(int $memberId): ResponseInterface
    {
        return $this->decorator->setId($memberId)
            ->fetchWallet();
    }
}
