<?php
namespace DrdPlus\Tests\Races\Orcs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\GenderCode;
use DrdPlus\Codes\PropertyCode;

class SkurutTest extends OrcTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCode::STRENGTH => 1,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => -1,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => -2,
            ],
            Female::FEMALE => [
                PropertyCode::STRENGTH => 0,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => -1,
                PropertyCode::WILL => 1,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => -2,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCode::SIZE => [
                GenderCode::MALE => 1,
                GenderCode::FEMALE => 0,
            ],
            PropertyCode::WEIGHT_IN_KG => [
                GenderCode::MALE => 90.0,
                GenderCode::FEMALE => 80.0,
            ],
            PropertyCode::HEIGHT_IN_CM => 180.0,
            PropertyCode::HEIGHT => 5,
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