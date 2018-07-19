<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Humans;

use DrdPlus\Codes\SubRaceCode;

class Highlander extends Human
{
    const HIGHLANDER = SubRaceCode::HIGHLANDER;

    /**
     * @return Human|Highlander
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::HIGHLANDER));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::HIGHLANDER);
    }

}