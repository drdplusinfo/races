<?php
namespace DrdPlus\Races\Elves;

use DrdPlus\Codes\SubRaceCode;

class CommonElf extends Elf
{
    const COMMON = SubRaceCode::COMMON;

    /**
     * @return Elf|CommonElf
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