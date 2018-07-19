<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Orcs;

use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Race;

abstract class Orc extends Race
{
    const ORC = RaceCode::ORC;

    /**
     * @param SubRaceCode $subraceCode
     * @return Race|Orc
     */
    protected static function getItBySubrace(SubRaceCode $subraceCode)
    {
        return parent::getItByRaceAndSubrace(RaceCode::getIt(self::ORC), $subraceCode);
    }

    /**
     * @return RaceCode
     */
    public function getRaceCode()
    {
        return RaceCode::getIt(self::ORC);
    }

}