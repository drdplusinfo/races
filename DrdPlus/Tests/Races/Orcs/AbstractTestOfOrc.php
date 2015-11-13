<?php
namespace DrdPlus\Tests\Races\Orcs;

use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

abstract class AbstractTestOfOrc extends AbstractTestOfRace
{
    protected function getExpectedOtherProperty($propertyCode)
    {
        $properties = [
            PropertyCodes::SENSES => 1,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::INFRAVISION => true,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => true,
        ];

        return $properties[$propertyCode];
    }

    protected function getExpectedRemarkableSense()
    {
        return PropertyCodes::SMELL;
    }

}
