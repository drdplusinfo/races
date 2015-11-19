<?php
namespace DrdPlus\Tests\Races\Orcs;

use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\PropertyCodes;

class GoblinTest extends AbstractTestOfOrc
{
    protected function getExpectedBodyProperty($genderCode, $propertyCode)
    {
        $properties = [
            PropertyCodes::STRENGTH => [
                GenderCodes::MALE => -1,
                GenderCodes::FEMALE => -2,
            ],
            PropertyCodes::AGILITY => 2,
            PropertyCodes::KNACK => 1,
            PropertyCodes::WILL => [
                GenderCodes::MALE => -2,
                GenderCodes::FEMALE => -1,
            ],
            PropertyCodes::INTELLIGENCE => 0,
            PropertyCodes::CHARISMA => -1,
        ];


        return isset($properties[$propertyCode][$genderCode])
            ? $properties[$propertyCode][$genderCode]
            : $properties[$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SIZE => [
                GenderCodes::MALE => -1,
                GenderCodes::FEMALE => -2
            ],
            PropertyCodes::WEIGHT_IN_KG => [
                GenderCodes::MALE => 55.0,
                GenderCodes::FEMALE => 50.0,
            ],
            PropertyCodes::HEIGHT_IN_CM => 150.0,
        ];


        if (isset($properties[$propertyCode][$genderCode])) {
            return $properties[$propertyCode][$genderCode];
        }
        if (isset($properties[$propertyCode])) {
            return $properties[$propertyCode];
        }

        return parent::getExpectedOtherProperty($propertyCode, $genderCode);
    }
}
