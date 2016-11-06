<?php
namespace DrdPlus\Races\Elves;

use DrdPlus\Races\Race;

abstract class Elf extends Race
{
    const ELF = 'elf';

    /**
     * @param string $subraceCode
     * @return Elf|Race
     */
    protected static function getItBySubrace($subraceCode)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return parent::getItByRaceAndSubrace(self::ELF, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::ELF;
    }

}