<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate;

use OnurSimsek\Craftgate\Contracts\RequestInterface;

class Util
{
    public static function guid(): string
    {
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(md5(self::pool()), 4));
    }

    private static function pool(int $length = 32): string
    {
        if (function_exists('random_bytes')) {
            return random_bytes($length);
        }

        srand();
        $input = uniqid();
        while (strlen($input) < $length) {
            $input = substr($input . dechex(rand()), 0, $length);
        }

        return $input;
    }

    public static function signature(RequestInterface $request, $salt): string
    {
        $options = $request->options();
        $psrRequest = $request->psrRequest();

        $hash = $psrRequest->getUri()
            . $options->getApiKey()
            . $options->getSecretKey()
            . $salt
            . ($psrRequest->getBody()->getSize() ? $psrRequest->getBody()->getContents() : '');

        return base64_encode(hash('sha256', $hash, true));
    }
}
