<?php
namespace DrdPlus\Tests\Races\Humans;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;

class CommonHumanTest extends AbstractTestOfHuman
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 0,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => 0,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => -1,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => 1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
