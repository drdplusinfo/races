<?php
namespace DrdPlus\Tests\Races\Humans;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;

class HighlanderTest extends AbstractTestOfHuman
{
    protected function getExpectedBodyProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 1,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 1,
                PropertyCodes::INTELLIGENCE => -1,
                PropertyCodes::CHARISMA => -1,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => 0,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 1,
                PropertyCodes::INTELLIGENCE => -1,
                PropertyCodes::CHARISMA => 0,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
