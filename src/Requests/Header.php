<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

enum Header: string
{
    case ClientVersion = 'x-client-version';
    case AuthVersion = 'x-auth-version';
    case ApiKey = 'x-api-key';
    case RandomKey = 'x-rnd-key';
    case Signature = 'x-signature';
}
