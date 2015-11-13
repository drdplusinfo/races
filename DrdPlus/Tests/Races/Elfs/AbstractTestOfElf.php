<?php
namespace DrdPlus\Tests\Races\Elfs;

use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

abstract class AbstractTestOfElf extends AbstractTestOfRace
{
    protected function getExpectedOtherProperty($propertyCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => -1,
            PropertyCodes::SIZE => -1,
            PropertyCodes::WEIGHT_IN_KG => 50.0,
            PropertyCodes::HEIGHT_IN_CM => 160.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
        ];

        return $properties[$propertyCode];
    }

    protected function getExpectedRemarkableSense()
    {
        return PropertyCodes::SIGHT;
    }

}
