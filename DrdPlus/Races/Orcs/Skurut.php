<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Orcs;

use DrdPlus\Codes\SubRaceCode;

class Skurut extends Orc
{
    const SKURUT = SubRaceCode::SKURUT;

    /**
     * @return Orc|Skurut
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::SKURUT));
    }

    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::SKURUT);
    }

}