<?php
namespace DrdPlus\Tests\Races\Elves;

use DrdPlus\Codes\GenderCode;
use DrdPlus\Codes\PropertyCode;

class GreenElfTest extends ElfTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            GenderCode::MALE => [
                PropertyCode::STRENGTH => -1,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => -1,
                PropertyCode::INTELLIGENCE => 1,
                PropertyCode::CHARISMA => 1,
            ],
            GenderCode::FEMALE => [
                PropertyCode::STRENGTH => -2,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => 1,
                PropertyCode::WILL => -1,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => 2,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }
}