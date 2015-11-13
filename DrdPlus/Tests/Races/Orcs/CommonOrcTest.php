<?php
namespace DrdPlus\Tests\Races\Orcs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;

class CommonOrcTest extends AbstractTestOfOrc
{
    protected function getExpectedBodyProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 0,
                PropertyCodes::AGILITY => 2,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => -1,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => -2,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => -1,
                PropertyCodes::AGILITY => 2,
                PropertyCodes::KNACK => 0,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => -2,
            ],
        ];

        return $properties[$genderCode][$propertyCode];
    }

    protected function getExpectedOtherProperty($propertyCode)
    {
        switch ($propertyCode) {
            case PropertyCodes::SIZE :
                return -1;
            case PropertyCodes::WEIGHT_IN_KG :
                return 60.0;
            case PropertyCodes::HEIGHT_IN_CM :
                return 160.0;
            default :
                return parent::getExpectedOtherProperty($propertyCode);
        }
    }

}
