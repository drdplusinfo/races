<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Krolls;

use DrdPlus\Codes\SubRaceCode;

class CommonKroll extends Kroll
{
    const COMMON = SubRaceCode::COMMON;

    /**
     * @return Kroll|CommonKroll
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