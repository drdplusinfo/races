<?php
namespace DrdPlus\Tests\Races\Orcs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\PropertyCodes;

class SkurutTest extends OrcTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 1,
                PropertyCodes::AGILITY => 1,
                PropertyCodes::KNACK => -1,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => -2,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => 0,
                PropertyCodes::AGILITY => 1,
                PropertyCodes::KNACK => -1,
                PropertyCodes::WILL => 1,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => -2,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCodes::SIZE => [
                GenderCodes::MALE => 1,
                GenderCodes::FEMALE => 0,
            ],
            PropertyCodes::WEIGHT_IN_KG => [
                GenderCodes::MALE => 90.0,
                GenderCodes::FEMALE => 80.0,
            ],
            PropertyCodes::HEIGHT_IN_CM => 180.0,
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
