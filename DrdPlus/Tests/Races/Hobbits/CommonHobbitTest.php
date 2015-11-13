<?php
namespace DrdPlus\Races\Hobbits;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Tests\Races\AbstractTestOfRace;

class CommonHobbitTest extends AbstractTestOfRace
{
    protected function getExpectedProperty($genderCode, $propertyCode)
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

}
