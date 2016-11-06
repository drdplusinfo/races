<?php
namespace DrdPlus\Races\Orcs;

use DrdPlus\Races\Race;

abstract class Orc extends Race
{
    const ORC = 'orc';

    protected static function getItBySubrace($subraceCode)
    {
        return parent::getItByRaceAndSubrace(self::ORC, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::ORC;
    }

}