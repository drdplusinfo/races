<?php
namespace DrdPlus\Tests\Races\Humans;

use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

abstract class AbstractTestOfHuman extends AbstractTestOfRace
{
    protected function getExpectedOtherProperty($propertyCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::SIZE => 0,
            PropertyCodes::WEIGHT_IN_KG => 80.0,
            PropertyCodes::HEIGHT_IN_CM => 180.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
        ];

        return $properties[$propertyCode];
    }

    protected function getExpectedRemarkableSense()
    {
        return '';
    }

}
