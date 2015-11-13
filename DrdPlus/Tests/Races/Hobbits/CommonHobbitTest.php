<?php
namespace DrdPlus\Tests\Races\Hobbits;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

class CommonHobbitTest extends AbstractTestOfRace
{
    protected function getExpectedBodyProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => -3,
                PropertyCodes::AGILITY => 1,
                PropertyCodes::KNACK => 1,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => -1,
                PropertyCodes::CHARISMA => 2,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => -4,
                PropertyCodes::AGILITY => 2,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => -1,
                PropertyCodes::CHARISMA => 3,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode)
    {
        $properties = [
            PropertyCodes::SENSES => 0,
            PropertyCodes::TOUGHNESS => 0,
            PropertyCodes::SIZE => -2,
            PropertyCodes::WEIGHT_IN_KG => 40.0,
            PropertyCodes::HEIGHT_IN_CM => 110.0,
            PropertyCodes::INFRAVISION => false,
            PropertyCodes::NATIVE_REGENERATION => false,
            PropertyCodes::REQUIRES_DM_AGREEMENT => false,
        ];

        return $properties[$propertyCode];
    }

    protected function getExpectedRemarkableSense()
    {
        return PropertyCodes::TASTE;
    }

}
