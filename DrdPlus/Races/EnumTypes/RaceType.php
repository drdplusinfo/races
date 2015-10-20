<?php
namespace DrdPlus\Races\EnumTypes;

use Doctrineum\Scalar\EnumType;
use DrdPlus\Races\Exceptions\GenericRaceCanNotBeCreated;
use DrdPlus\Races\Race;

class RaceType extends EnumType
{
    const RACE = 'race';

    /**
     * @param string $raceAndSubraceCode
     *
     * @return string
     */
    protected static function getEnumClass($raceAndSubraceCode)
    {
        $specificRaceClass = parent::getEnumClass($raceAndSubraceCode);
        if ($specificRaceClass === __CLASS__) {
            throw new GenericRaceCanNotBeCreated(
                "Given race and subrace code {$raceAndSubraceCode} is not paired with specific race class"
            );
        }

        return $specificRaceClass;
    }

    public static function registerRaceAsSubType(Race $race)
    {
        if (static::hasSubTypeEnum(get_class($race))) {
            return true;
        }

        return static::addSubTypeEnum(get_class($race), "~^$race$~");
    }

}
