<?php
namespace DrdPlus\Races\Dwarfs;

use DrdPlus\Races\Race;

abstract class Dwarf extends Race
{
    const DWARF = 'dwarf';

    /**
     * @param string $subraceCode
     * @return static
     */
    protected static function getItBySubrace($subraceCode)
    {
        return parent::getItByRaceAndSubrace(self::DWARF, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::DWARF;
    }

}
