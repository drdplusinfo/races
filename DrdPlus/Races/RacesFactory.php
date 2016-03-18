<?php
namespace DrdPlus\Races;

use DrdPlus\Races\Humans\Highlander;
use DrdPlus\Races\Orcs\CommonOrc;
use DrdPlus\Races\Orcs\Orc;
use Granam\Scalar\Tools\ToString;
use Granam\Strict\Object\StrictObject;
use Granam\Tools\ValueDescriber;

class RacesFactory extends StrictObject
{
    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return Race
     * @throws \DrdPlus\Races\Exceptions\UnknownRaceCode
     */
    public static function getSubRaceByCodes($raceCode, $subraceCode)
    {
        $subraceClass = static::getSubraceClassByCodes($raceCode, $subraceCode);

        return $subraceClass::getEnum($subraceClass::createRaceAndSubraceCode($raceCode, $subraceCode));
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return string|Race
     * @throws \DrdPlus\Races\Exceptions\InvalidRaceCode
     * @throws \DrdPlus\Races\Exceptions\UnknownRaceCode
     */
    protected static function getSubraceClassByCodes($raceCode, $subraceCode)
    {
        try {
            $raceCode = ToString::toString($raceCode);
            $subraceCode = ToString::toString($subraceCode);
        } catch (\Granam\Scalar\Tools\Exceptions\WrongParameterType $exception) {
            throw new Exceptions\InvalidRaceCode(
                'Both race codes have to be represented by string, got '
                . ValueDescriber::describe($raceCode) . ', ' . ValueDescriber::describe($subraceCode),
                $exception->getCode(),
                $exception
            );
        }
        $subraceNamespace = __NAMESPACE__ . '\\' . ucfirst($raceCode) . 's' . '\\';
        if ($raceCode !== Orc::ORC || $subraceCode === CommonOrc::COMMON) {
            if ($subraceCode !== Highlander::HIGHLANDER) {
                $subraceClass = $subraceNamespace . ucfirst($subraceCode) . ucfirst($raceCode);
            } else {
                $subraceClass = $subraceNamespace . ucfirst($subraceCode);
            }
        } else {
            $subraceClass = $subraceNamespace . ucfirst($subraceCode);
        }
        if (!class_exists($subraceClass)) {
            throw new Exceptions\UnknownRaceCode(
                'Was searching for class ' . $subraceClass
                . ' created from race code ' . ValueDescriber::describe($raceCode)
                . ' and sub-race code ' . ValueDescriber::describe($subraceCode)
            );
        }

        return $subraceClass;
    }

}