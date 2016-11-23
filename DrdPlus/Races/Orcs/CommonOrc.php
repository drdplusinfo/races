<?php
namespace DrdPlus\Races\Orcs;

use DrdPlus\Codes\SubRaceCode;

class CommonOrc extends Orc
{
    const COMMON = SubRaceCode::COMMON;

    /**
     * @return Orc|CommonOrc
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