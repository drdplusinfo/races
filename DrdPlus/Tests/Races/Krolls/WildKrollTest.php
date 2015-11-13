<?php
namespace DrdPlus\Races\Krolls;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

class WildKrollTest extends AbstractTestOfRace
{
    protected function getExpectedProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 3,
                PropertyCodes::AGILITY => -1,
                PropertyCodes::KNACK => -2,
                PropertyCodes::WILL => 2,
                PropertyCodes::INTELLIGENCE => -3,
                PropertyCodes::CHARISMA => -2,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => 2,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => -2,
                PropertyCodes::WILL => 1,
                PropertyCodes::INTELLIGENCE => -3,
                PropertyCodes::CHARISMA => -1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
