<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Dwarfs;

use DrdPlus\Codes\SubRaceCode;

class CommonDwarf extends Dwarf
{
    const COMMON = SubRaceCode::COMMON;

    /**
     * @return CommonDwarf|Dwarf
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