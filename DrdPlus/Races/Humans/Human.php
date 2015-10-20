<?php
namespace DrdPlus\Races\Humans;

use DrdPlus\Races\Race;

abstract class Human extends Race
{
    const HUMAN = 'human';

    protected static function getIt($subraceCode)
    {
        return parent::getIt(self::HUMAN, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::HUMAN;
    }

}
