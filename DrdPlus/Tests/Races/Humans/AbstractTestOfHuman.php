<?php
namespace DrdPlus\Tests\Races\Humans;

use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\RaceTest;

abstract class AbstractTestOfHuman extends RaceTest
{
    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::SIZE => [
                GenderCodes::MALE => 0,
                GenderCodes::FEMALE => -1,
            ],
            PropertyCodes::WEIGHT_IN_KG => [
                GenderCodes::MALE => 80.0,
                GenderCodes::FEMALE => 70.0,
            ],
            PropertyCodes::HEIGHT_IN_CM => 180.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
            PropertyCodes::REMARKABLE_SENSE => '',
        ];


        return isset($properties[$propertyCode][$genderCode])
            ? $properties[$propertyCode][$genderCode]
            : $properties[$propertyCode];
    }
}
