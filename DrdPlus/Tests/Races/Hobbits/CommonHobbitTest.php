<?php
namespace DrdPlus\Tests\Races\Hobbits;

use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

class CommonHobbitTest extends AbstractTestOfRace
{
    protected function getExpectedBodyProperty($genderCode, $propertyCode)
    {
        $properties = [
            PropertyCodes::STRENGTH => [
                GenderCodes::MALE => -3,
                GenderCodes::FEMALE => -4,
            ],
            PropertyCodes::AGILITY => [
                GenderCodes::MALE => 1,
                GenderCodes::FEMALE => 2,
            ],
            PropertyCodes::KNACK => [
                GenderCodes::MALE => 1,
                GenderCodes::FEMALE => 0,
            ],
            PropertyCodes::WILL => 0,
            PropertyCodes::INTELLIGENCE => -1,
            PropertyCodes::CHARISMA => [
                GenderCodes::MALE => 2,
                GenderCodes::FEMALE => 3,
            ],
        ];

        return isset($properties[$propertyCode][$genderCode])
            ? $properties[$propertyCode][$genderCode]
            : $properties[$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::SIZE => [
                GenderCodes::MALE => -2,
                GenderCodes::FEMALE => -3,
            ],
            PropertyCodes::WEIGHT_IN_KG => [
                GenderCodes::MALE => 40.0,
                GenderCodes::FEMALE => 36.0
            ],
            PropertyCodes::HEIGHT_IN_CM => 110.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
            PropertyCodes::REMARKABLE_SENSE => PropertyCodes::TASTE,
        ];

        return isset($properties[$propertyCode][$genderCode])
            ? $properties[$propertyCode][$genderCode]
            : $properties[$propertyCode];
    }
}
