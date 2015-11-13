<?php
namespace DrdPlus\Tests\Races\Orcs;

use Drd\Genders\Female;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;

class SkurutTest extends AbstractTestOfOrc
{
    protected function getExpectedBodyProperty($genderCode, $propertyCode)
    {
        $properties = [
            Male::MALE => [
                PropertyCodes::STRENGTH => 1,
                PropertyCodes::AGILITY => 1,
                PropertyCodes::KNACK => -1,
                PropertyCodes::WILL => 0,
                PropertyCodes::INTELLIGENCE => 0,
                PropertyCodes::CHARISMA => -2,
            ],
            Female::FEMALE => [
                PropertyCodes::STRENGTH => 0,
                PropertyCodes::AGILITY => 1,
                PropertyCodes::KNACK => -1,
                PropertyCodes::WILL => 1,
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
                return 1;
            case PropertyCodes::WEIGHT_IN_KG :
                return 90.0;
            case PropertyCodes::HEIGHT_IN_CM :
                return 180.0;
            default :
                return parent::getExpectedOtherProperty($propertyCode);
        }
    }
}
