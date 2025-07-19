<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Requests;

enum HttpVerb: string
{
    case Get = 'get';
    case Post = 'post';
    case Delete = 'delete';
}
