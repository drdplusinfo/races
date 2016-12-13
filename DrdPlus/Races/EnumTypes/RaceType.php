<?php
namespace DrdPlus\Races\EnumTypes;

use Doctrineum\Scalar\ScalarEnumType;
use DrdPlus\Races\Race;

class RaceType extends ScalarEnumType
{
    const RACE = 'race';

    /**
     * @param Race $race
     * @return bool
     */
    public static function registerRaceAsSubType(Race $race)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        if (static::hasSubTypeEnum(get_class($race))) {
            return false;
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return static::addSubTypeEnum(get_class($race), "~^$race$~");
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::RACE;
    }

}