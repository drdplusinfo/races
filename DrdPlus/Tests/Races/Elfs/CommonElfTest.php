<?php
namespace DrdPlus\Tests\Races\Elfs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCode;

class CommonElfTest extends ElfTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCode::STRENGTH => -1,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => 1,
                PropertyCode::WILL => -2,
                PropertyCode::INTELLIGENCE => 1,
                PropertyCode::CHARISMA => 1,
            ],
            Female::FEMALE => [
                PropertyCode::STRENGTH => -2,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => 2,
                PropertyCode::WILL => -2,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => 2,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
