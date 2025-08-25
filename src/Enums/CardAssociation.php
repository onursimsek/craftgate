<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum CardAssociation: string
{
    case Visa = 'VISA';
    case MasterCard = 'MASTER_CARD';
    case Amex = 'AMEX';
    case Troy = 'TROY';
    case JCB = 'JCB';
    case UnionPay = 'UNION_PAY';
    case Maestro = 'MAESTRO';
    case Discover = 'DISCOVER';
    case DinersClub = 'DINERS_CLUB';
}
