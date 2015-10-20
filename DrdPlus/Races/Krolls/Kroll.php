<?php
namespace DrdPlus\Races\Krolls;

use DrdPlus\Races\Race;

abstract class Kroll extends Race
{
    const KROLL = 'kroll';

    protected static function getIt($subraceCode)
    {
        return parent::getIt(self::KROLL, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::KROLL;
    }

}
