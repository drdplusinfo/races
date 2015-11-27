<?php
namespace DrdPlus\Tests\Races\Krolls;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;

class WildKrollTest extends AbstractTestOfKroll
{
    protected function getExpectedBaseProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 3,
                PropertyCodes::AGILITY => -1,
                PropertyCodes::KNACK => -2,
                PropertyCodes::WILL => 2,
                PropertyCodes::INTELLIGENCE => -3,
                PropertyCodes::CHARISMA => -2,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => 2,
                PropertyCodes::AGILITY => 0,
                PropertyCodes::KNACK => -2,
                PropertyCodes::WILL => 1,
                PropertyCodes::INTELLIGENCE => -3,
                PropertyCodes::CHARISMA => -1,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        if ($propertyCode === PropertyCodes::REQUIRES_DM_AGREEMENT) {
            return true;
        }

        return parent::getExpectedOtherProperty($propertyCode, $genderCode);
    }
}
