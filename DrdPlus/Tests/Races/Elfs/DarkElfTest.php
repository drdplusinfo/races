<?php
namespace DrdPlus\Races\Elfs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

class DarkElfTest extends AbstractTestOfRace
{
    protected function getExpectedProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 0,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 1,
                PropertyCodes::CHARISMA => 0,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => -1,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 1,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => 1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
