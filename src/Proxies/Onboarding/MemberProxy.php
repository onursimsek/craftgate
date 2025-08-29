<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Proxies\Onboarding;

use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\Onboarding\Member;
use OnurSimsek\Craftgate\ValueObjects\Onboarding\CreateBuyer;
use OnurSimsek\Craftgate\ValueObjects\Onboarding\CreateBuyerAndMerchant;
use OnurSimsek\Craftgate\ValueObjects\Onboarding\CreateMerchant;
use OnurSimsek\Craftgate\ValueObjects\Onboarding\SearchMember;
use OnurSimsek\Craftgate\ValueObjects\Onboarding\UpdateMember;
use Psr\Http\Message\ResponseInterface;

final class MemberProxy implements Proxy
{
    public function __construct(public readonly Member $decorator)
    {
    }

    public function createMember(array $params): ResponseInterface
    {
        $data = match (true) {
            $params['isBuyer'] && $params['isSubMerchant'] => CreateBuyerAndMerchant::fromArray($params),
            $params['isBuyer'] => CreateBuyer::fromArray($params),
            $params['isSubMerchant'] => CreateMerchant::fromArray($params),
        };

        return $this->decorator->create($data);
    }

    public function updateMember(int $memberId, array $params): ResponseInterface
    {
        return $this->decorator->update($memberId, UpdateMember::fromArray($params));
    }

    public function retrieveMember(int $memberId): ResponseInterface
    {
        return $this->decorator->fetch($memberId);
    }

    public function searchMembers(array $params): ResponseInterface
    {
        return $this->decorator->search(SearchMember::fromArray($params));
    }
}
