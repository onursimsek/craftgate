<?php

namespace OnurSimsek\Craftgate\Requests;

enum HttpVerb: string
{
    case Get = 'get';
    case Post = 'post';
    case Delete = 'delete';
}
