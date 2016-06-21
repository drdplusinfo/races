<?php
namespace DrdPlus\Tests\Races\Dwarfs;

use DrdPlus\Codes\PropertyCode;
use DrdPlus\Tests\Races\RaceTest;

abstract class DwarfTest extends RaceTest
{
    protected function getExpectedOtherProperty($propertyCode, $genderCode)
    {
        $properties = [
            PropertyCode::SENSES => -1,
            PropertyCode::TOUGHNESS => 1,
            PropertyCode::SIZE => 0,
            PropertyCode::WEIGHT_IN_KG => 70.0,
            PropertyCode::HEIGHT_IN_CM => 140.0,
            PropertyCode::INFRAVISION => true,
            PropertyCode::NATIVE_REGENERATION => false,
            PropertyCode::REQUIRES_DM_AGREEMENT => false,
            PropertyCode::REMARKABLE_SENSE => PropertyCode::TOUCH,
        ];

        return $properties[$propertyCode];
    }
}
