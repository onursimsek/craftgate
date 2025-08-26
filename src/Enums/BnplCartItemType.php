<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Enums;

enum BnplCartItemType: string
{
    case MobilePhoneOver5000Try = 'MOBILE_PHONE_OVER_5000_TRY';
    case MobilePhoneBelow5000Try = 'PAYONEER';
    case Tablet = 'TABLET';
    case Computer = 'COMPUTER';
    case ConstructionMarket = 'CONSTRUCTION_MARKET';
    case Gold = 'GOLD';
    case DigitalProducts = 'DIGITAL_PRODUCTS';
    case Supermarket = 'SUPERMARKET';
    case WhiteGoods = 'WHITE_GOODS';
    case WearableTechnology = 'WEARABLE_TECHNOLOGY';
    case SmallHomeAppliances = 'SMALL_HOME_APPLIANCES';
    case Tv = 'TV';
    case GamesConsoles = 'GAMES_CONSOLES';
    case AirConditionerAndHeater = 'AIR_CONDITIONER_AND_HEATER';
    case Electronics = 'ELECTRONICS';
    case MomAndBabyAndKids = 'MOM_AND_BABY_AND_KIDS';
    case Shoes = 'SHOES';
    case Clothing = 'CLOTHING';
    case CosmeticsAndPersonalCare = 'COSMETICS_AND_PERSONAL_CARE';
    case Furniture = 'FURNITURE';
    case HomeLiving = 'HOME_LIVING';
    case AutomobileMotorcycle = 'AUTOMOBILE_MOTORCYCLE';
    case Other = 'OTHER';
}
