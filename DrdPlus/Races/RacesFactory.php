<?php
declare(strict_types = 1);

namespace DrdPlus\Races;

use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Dwarfs\WoodDwarf;
use DrdPlus\Races\Humans\Highlander;
use DrdPlus\Races\Orcs\CommonOrc;
use DrdPlus\Races\Orcs\Orc;
use Granam\Strict\Object\StrictObject;

class RacesFactory extends StrictObject
{
    /**
     * @param RaceCode $raceCode
     * @param SubRaceCode $subraceCode
     * @return Race
     * @throws \DrdPlus\Races\Exceptions\UnknownRaceCode
     */
    public static function getSubRaceByCodes(RaceCode $raceCode, SubRaceCode $subraceCode)
    {
        $subraceClass = static::getSubraceClassByCodes($raceCode, $subraceCode);

        return $subraceClass::getIt();
    }

    /**
     * @param RaceCode $raceCode
     * @param SubRaceCode $subraceCode
     * @return string|Race|WoodDwarf|CommonOrc ...
     * @throws \DrdPlus\Races\Exceptions\UnknownRaceCode
     */
    private static function getSubraceClassByCodes(RaceCode $raceCode, SubRaceCode $subraceCode)
    {
        $raceCodeValue = $raceCode->getValue();
        $subraceCodeValue = $subraceCode->getValue();
        if ($raceCodeValue === RaceCode::ELF) {
            $baseNamespace = 'elves';
        } else {
            $baseNamespace = $raceCodeValue . 's';
        }
        $subraceNamespace = __NAMESPACE__ . '\\' . ucfirst($baseNamespace) . '\\';
        if ($raceCodeValue !== Orc::ORC || $subraceCodeValue === CommonOrc::COMMON) {
            if ($subraceCodeValue !== Highlander::HIGHLANDER) {
                $subraceClass = $subraceNamespace . ucfirst($subraceCodeValue) . ucfirst($raceCodeValue);
            } else {
                $subraceClass = $subraceNamespace . ucfirst($subraceCodeValue);
            }
        } else {
            $subraceClass = $subraceNamespace . ucfirst($subraceCodeValue);
        }
        if (!class_exists($subraceClass)) {
            throw new Exceptions\UnknownRaceCode(
                "Was searching for class {$subraceClass}" . " created from race code {$raceCodeValue} and sub-race code {$subraceCodeValue}"
            );
        }

        return $subraceClass;
    }

}