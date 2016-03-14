<?php
namespace DrdPlus\Tests\Races\Krolls;

use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\RaceTest;

abstract class AbstractTestOfKroll extends RaceTest
{
    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::SIZE => [
                GenderCodes::MALE => 3,
                GenderCodes::FEMALE => 2,
            ],
            PropertyCodes::WEIGHT_IN_KG => [
                GenderCodes::MALE => 120.0,
                GenderCodes::FEMALE => 110.0,
            ],
            PropertyCodes::HEIGHT_IN_CM => 220.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => true,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
            PropertyCodes::REMARKABLE_SENSE => PropertyCodes::HEARING,
        ];

        return isset($properties[$propertyCode][$genderCode])
            ? $properties[$propertyCode][$genderCode]
            : $properties[$propertyCode];
    }
}
