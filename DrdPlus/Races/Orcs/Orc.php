<?php
namespace DrdPlus\Races\Orcs;

use DrdPlus\Races\Race;

abstract class Orc extends Race
{
    const ORC = 'orc';

    protected static function getIt($subraceCode)
    {
        return parent::getIt(self::ORC, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::ORC;
    }

}
