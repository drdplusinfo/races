<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Orcs;

use DrdPlus\Codes\SubRaceCode;

class Goblin extends Orc
{
    const GOBLIN = SubRaceCode::GOBLIN;

    /**
     * @return Orc|Goblin
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::GOBLIN));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::GOBLIN);
    }

}