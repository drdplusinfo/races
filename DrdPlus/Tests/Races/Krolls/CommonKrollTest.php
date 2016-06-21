<?php
namespace DrdPlus\Tests\Races\Krolls;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCode;

class CommonKrollTest extends KrollTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCode::STRENGTH => 3,
                PropertyCode::AGILITY => -2,
                PropertyCode::KNACK => -1,
                PropertyCode::WILL => 1,
                PropertyCode::INTELLIGENCE => -3,
                PropertyCode::CHARISMA => -1,
            ],
            Female::FEMALE => [
                PropertyCode::STRENGTH => 2,
                PropertyCode::AGILITY => -1,
                PropertyCode::KNACK => -1,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => -3,
                PropertyCode::CHARISMA => 0,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}
