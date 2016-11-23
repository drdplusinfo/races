<?php
namespace DrdPlus\Tests\Races\Elves;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCode;

class DarkElfTest extends ElfTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCode::STRENGTH => 0,
                PropertyCode::AGILITY => 0,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 1,
                PropertyCode::CHARISMA => 0,
            ],
            Female::FEMALE => [
                PropertyCode::STRENGTH => -1,
                PropertyCode::AGILITY => 0,
                PropertyCode::KNACK => 1,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => 1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        switch ($propertyCode) {
            case PropertyCode::INFRAVISION :
                return true;
            case PropertyCode::REQUIRES_DM_AGREEMENT :
                return true;
            default :
                return parent::getExpectedOtherProperty($propertyCode, $genderCode);
        }
    }
}