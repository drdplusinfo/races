<?php
namespace DrdPlus\Races\Elves;

use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Race;

abstract class Elf extends Race
{
    const ELF = RaceCode::ELF;

    /**
     * @param SubRaceCode $subraceCode
     * @return Elf|Race
     */
    protected static function getItBySubrace(SubRaceCode $subraceCode)
    {
        return parent::getItByRaceAndSubrace(RaceCode::getIt(self::ELF), $subraceCode);
    }

    /**
     * @return RaceCode
     */
    public function getRaceCode()
    {
        return RaceCode::getIt(self::ELF);
    }

}