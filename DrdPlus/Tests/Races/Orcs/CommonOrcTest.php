<?php
namespace DrdPlus\Tests\Races\Orcs;

use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\PropertyCodes;

class CommonOrcTest extends OrcTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            PropertyCodes::STRENGTH => [
                GenderCodes::MALE => 0,
                GenderCodes::FEMALE => -1,
            ],
            PropertyCodes::AGILITY => 2,
            PropertyCodes::KNACK => 0,
            PropertyCodes::WILL => [
                GenderCodes::MALE => -1,
                GenderCodes::FEMALE => 0,
            ],
            PropertyCodes::INTELLIGENCE => 0,
            PropertyCodes::CHARISMA => -2,
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
                GenderCodes::FEMALE => -2,
            ],
            PropertyCodes::WEIGHT_IN_KG => [
                GenderCodes::MALE => 60.0,
                GenderCodes::FEMALE => 56.0,
            ],
            PropertyCodes::HEIGHT_IN_CM => 160.0,
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
