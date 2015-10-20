<?php
namespace DrdPlus\Races\EnumTypes;

use Doctrineum\Scalar\EnumType;
use DrdPlus\Races\Race;

class RaceType extends EnumType
{
    const RACE = 'race';

    public static function registerRaceAsSubType(Race $race)
    {
        if (static::hasSubTypeEnum(get_class($race))) {
            return false;
        }

        return static::addSubTypeEnum(get_class($race), "~^$race$~");
    }

}
