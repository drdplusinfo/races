<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Humans;

use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Race;

abstract class Human extends Race
{
    const HUMAN = RaceCode::HUMAN;

    /**
     * @param SubRaceCode $subraceCode
     * @return Race|Human
     */
    protected static function getItBySubrace(SubRaceCode $subraceCode)
    {
        return parent::getItByRaceAndSubrace(RaceCode::getIt(self::HUMAN), $subraceCode);
    }

    /**
     * @return RaceCode
     */
    public function getRaceCode()
    {
        return RaceCode::getIt(self::HUMAN);
    }

}