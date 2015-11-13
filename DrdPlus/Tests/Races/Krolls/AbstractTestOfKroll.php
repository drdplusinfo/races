<?php
namespace DrdPlus\Tests\Races\Krolls;

use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

abstract class AbstractTestOfKroll extends AbstractTestOfRace
{
    protected function getExpectedOtherProperty($propertyCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::SIZE => 3,
            PropertyCodes::WEIGHT_IN_KG => 120.0,
            PropertyCodes::HEIGHT_IN_CM => 220.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => true,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
        ];

        return $properties[$propertyCode];
    }

    protected function getExpectedRemarkableSense()
    {
        return PropertyCodes::HEARING;
    }

}
