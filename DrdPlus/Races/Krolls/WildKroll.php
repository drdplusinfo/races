<?php
namespace DrdPlus\Races\Krolls;

use DrdPlus\Codes\SubRaceCode;

class WildKroll extends Kroll
{
    const WILD = SubRaceCode::WILD;

    /**
     * @return Kroll|WildKroll
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::WILD));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::WILD);
    }
}