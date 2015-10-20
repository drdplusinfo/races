<?php
namespace DrdPlus\Races\Hobbits;

use DrdPlus\Races\Race;

abstract class Hobbit extends Race
{
    const HOBBIT = 'hobbit';

    protected static function getItBySubrace($subraceCode)
    {
        return parent::getItByRaceAndSubrace(self::HOBBIT, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::HOBBIT;
    }
}
