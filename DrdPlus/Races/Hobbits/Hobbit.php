<?php
namespace DrdPlus\Races\Hobbits;

use DrdPlus\Races\Race;

abstract class Hobbit extends Race
{
    const HOBBIT = 'hobbit';

    protected static function getIt($subraceCode)
    {
        return parent::getIt(self::HOBBIT, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::HOBBIT;
    }
}
