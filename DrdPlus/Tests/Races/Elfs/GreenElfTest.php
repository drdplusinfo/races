<?php
namespace DrdPlus\Races\Elfs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

class GreenElfTest extends AbstractTestOfRace
{
    protected function getExpectedProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => -1,
                PropertyCodes::AGILITY => 1,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => -1,
                PropertyCodes::INTELLIGENCE => 1,
                PropertyCodes::CHARISMA => 1,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => -2,
                PropertyCodes::AGILITY => 1,
                PropertyCodes::KNACK => 1,
                PropertyCodes::WILL => -1,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => 2,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
