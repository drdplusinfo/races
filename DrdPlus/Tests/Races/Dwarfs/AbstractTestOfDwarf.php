<?php
namespace DrdPlus\Tests\Races\Dwarfs;

use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\RaceTest;

abstract class AbstractTestOfDwarf extends RaceTest
{
    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SENSES => -1,
            PropertyCodes::TOUGHNESS => 1,
            PropertyCodes::SIZE => 0,
            PropertyCodes::WEIGHT_IN_KG => 70.0,
            PropertyCodes::HEIGHT_IN_CM => 140.0,
            PropertyCodes::INFRAVISION => true,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
            PropertyCodes::REMARKABLE_SENSE => PropertyCodes::TOUCH,
        ];

        return $properties[$propertyCode];
    }
}
