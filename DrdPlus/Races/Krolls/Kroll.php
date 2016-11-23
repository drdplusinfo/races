<?php
namespace DrdPlus\Races\Krolls;

use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Race;

abstract class Kroll extends Race
{
    const KROLL = RaceCode::KROLL;

    /**
     * @param SubRaceCode $subraceCode
     * @return Race|Kroll
     */
    protected static function getItBySubrace(SubRaceCode $subraceCode)
    {
        return parent::getItByRaceAndSubrace(RaceCode::getIt(self::KROLL), $subraceCode);
    }

    /**
     * @return RaceCode
     */
    public function getRaceCode()
    {
        return RaceCode::getIt(self::KROLL);
    }

}