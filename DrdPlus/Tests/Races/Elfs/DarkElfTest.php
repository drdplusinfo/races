<?php
namespace DrdPlus\Tests\Races\Elfs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;

class DarkElfTest extends ElfTest
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 0,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 1,
                PropertyCodes::CHARISMA => 0,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => -1,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => 1,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => 1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        switch ($propertyCode) {
            case PropertyCodes::INFRAVISION :
                return true;
            case PropertyCodes::REQUIRES_DM_AGREEMENT :
                return true;
            default :
                return parent::getExpectedOtherProperty($propertyCode, $genderCode);
        }
    }
}
