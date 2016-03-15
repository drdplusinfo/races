<?php
namespace DrdPlus\Races;

use DrdPlus\Races\Humans\Highlander;
use DrdPlus\Races\Orcs\CommonOrc;
use DrdPlus\Races\Orcs\Orc;
use Granam\Strict\Object\StrictObject;
use Granam\Tools\ValueDescriber;

class RacesFactory extends StrictObject
{
    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return Race
     * @throws \DrdPlus\Races\Exceptions\UnexpectedRaceCode
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
     * @throws \DrdPlus\Races\Exceptions\UnexpectedRaceCode
     */
    protected static function getSubraceClassByCodes($raceCode, $subraceCode)
    {
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
            throw new Exceptions\UnexpectedRaceCode(
                'Was searching for class ' . $subraceClass
                . ' created from race code ' . ValueDescriber::describe($raceCode)
                . ' and sub-race code ' . ValueDescriber::describe($subraceCode)
            );
        }

        return $subraceClass;
    }

}