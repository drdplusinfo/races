<?php
namespace DrdPlus\Tests\Races\Krolls;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;

class CommonKrollTest extends AbstractTestOfKroll
{
    protected function getExpectedBodyProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 3,
                PropertyCodes::AGILITY => -2,
                PropertyCodes::KNACK => -1,
                PropertyCodes::WILL => 1,
                PropertyCodes::INTELLIGENCE => -3,
                PropertyCodes::CHARISMA => -1,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => 2,
                PropertyCodes::AGILITY => -1,
                PropertyCodes::KNACK => -1,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => -3,
                PropertyCodes::CHARISMA => 0,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
