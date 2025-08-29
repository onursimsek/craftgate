<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests\Onboarding;

use OnurSimsek\Craftgate\Concerns\Container;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Proxies\Onboarding\MemberProxy;
use OnurSimsek\Craftgate\Requests\HttpVerb;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\ValueObjects\Onboarding\Member as MemberValueObject;
use OnurSimsek\Craftgate\ValueObjects\Onboarding\SearchMember;
use Psr\Http\Message\ResponseInterface;

class Member extends RequestDecorator
{
    protected string $prefix = 'onboarding';

    public function create(MemberValueObject $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Post)
            ->withPath('members')
            ->withBody($data->toArray())
            ->send();
    }

    public function update(int $id, MemberValueObject $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Put)
            ->withPath('members', $id)
            ->withBody($data->toArray())
            ->send();
    }

    public function fetch(int $id): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('members', $id)
            ->send();
    }

    public function search(SearchMember $data): ResponseInterface
    {
        return $this->withMethod(HttpVerb::Get)
            ->withPath('members')
            ->withQuery($data->toArray())
            ->send();
    }

    protected function proxy(): Proxy
    {
        return Container::pushOrGet(MemberProxy::class, $this);
    }
}
