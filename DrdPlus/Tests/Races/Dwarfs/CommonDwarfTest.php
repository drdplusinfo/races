<?php
namespace DrdPlus\Tests\Races\Dwarfs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCode;

class CommonDwarfTest extends DwarfTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCode::STRENGTH => 1,
                PropertyCode::AGILITY => -1,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 2,
                PropertyCode::INTELLIGENCE => -1,
                PropertyCode::CHARISMA => -2,

            ],
            Female::FEMALE => [
                PropertyCode::STRENGTH => 1,
                PropertyCode::AGILITY => -1,
                PropertyCode::KNACK => -1,
                PropertyCode::WILL => 2,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => -2,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}