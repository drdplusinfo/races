<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Dwarfs;

use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Race;

abstract class Dwarf extends Race
{
    const DWARF = RaceCode::DWARF;

    /**
     * @param SubRaceCode $subraceCode
     * @return Dwarf|Race
     */
    protected static function getItBySubrace(SubRaceCode $subraceCode)
    {
        return parent::getItByRaceAndSubrace(RaceCode::getIt(self::DWARF), $subraceCode);
    }

    /**
     * @return RaceCode
     */
    public function getRaceCode()
    {
        return RaceCode::getIt(self::DWARF);
    }

}