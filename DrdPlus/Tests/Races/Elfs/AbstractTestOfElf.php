<?php
namespace DrdPlus\Tests\Races\Elfs;

use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\RaceTest;

abstract class AbstractTestOfElf extends RaceTest
{
    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => -1,
            PropertyCodes::SIZE => [
                GenderCodes::MALE => -1,
                GenderCodes::FEMALE => -2,
            ],
            PropertyCodes::WEIGHT_IN_KG => [
                GenderCodes::MALE => 50.0,
                GenderCodes::FEMALE => 45.0,
            ],
            PropertyCodes::HEIGHT_IN_CM => 160.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
            PropertyCodes::REMARKABLE_SENSE => PropertyCodes::SIGHT,
        ];

        return isset($properties[$propertyCode][$genderCode])
            ? $properties[$propertyCode][$genderCode]
            : $properties[$propertyCode];
    }
}
