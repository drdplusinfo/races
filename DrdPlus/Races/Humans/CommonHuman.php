<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Humans;

use DrdPlus\Codes\SubRaceCode;

class CommonHuman extends Human
{
    const COMMON = SubRaceCode::COMMON;

    /**
     * @return Human|CommonHuman
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::COMMON));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::COMMON);
    }

}