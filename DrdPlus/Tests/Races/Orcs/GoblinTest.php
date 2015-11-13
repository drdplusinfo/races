<?php
namespace DrdPlus\Races\Orcs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

class GoblinTest extends AbstractTestOfRace
{
    protected function getExpectedProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => -1,
                PropertyCodes::AGILITY => 2,
                PropertyCodes::KNACK => 1,
                PropertyCodes::WILL => -2,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => -1,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => -2,
                PropertyCodes::AGILITY => 2,
                PropertyCodes::KNACK => 1,
                PropertyCodes::WILL => -1,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => -1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
