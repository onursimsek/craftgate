<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Contracts;

use Psr\Http\Message\UriInterface;

interface Options extends Arrayable
{
    public function getApiKey(): string;
    public function getSecretKey(): string;
    public function getBaseUrl(): string;
    public function getUri(): UriInterface;
    public function getLanguage(): string;
    public function getClientVersion(): string;
    public function getAuthVersion(): string;
}
