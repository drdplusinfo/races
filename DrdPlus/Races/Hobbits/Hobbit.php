<?php
namespace DrdPlus\Races\Hobbits;

use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Race;

abstract class Hobbit extends Race
{
    const HOBBIT = RaceCode::HOBBIT;

    /**
     * @param SubRaceCode $subraceCode
     * @return Race|Hobbit
     */
    protected static function getItBySubrace(SubRaceCode $subraceCode)
    {
        return parent::getItByRaceAndSubrace(RaceCode::getIt(self::HOBBIT), $subraceCode);
    }

    /**
     * @return RaceCode
     */
    public function getRaceCode()
    {
        return RaceCode::getIt(self::HOBBIT);
    }
}