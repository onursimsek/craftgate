<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum PaymentPhase: string
{
    case Auth = 'AUTH';
    case PreAuth = 'PRE_AUTH';
    case PostAuth = 'POST_AUTH';
}
