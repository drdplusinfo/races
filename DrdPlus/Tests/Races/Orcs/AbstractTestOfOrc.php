<?php
namespace DrdPlus\Tests\Races\Orcs;

use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\RaceTest;

abstract class AbstractTestOfOrc extends RaceTest
{
    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SENSES => 1,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::INFRAVISION => true,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => true,
            PropertyCodes::REMARKABLE_SENSE => PropertyCodes::SMELL,
        ];

        return $properties[$propertyCode];
    }
}
