<?php
namespace DrdPlus\Tests\Races\Humans;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCode;

class CommonHumanTest extends HumanTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCode::STRENGTH => 0,
                PropertyCode::AGILITY => 0,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => 0,
            ],
            Female::FEMALE => [
                PropertyCode::STRENGTH => -1,
                PropertyCode::AGILITY => 0,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => 1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}