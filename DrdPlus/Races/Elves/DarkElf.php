<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Elves;

use DrdPlus\Codes\SubRaceCode;

class DarkElf extends Elf
{
    const DARK = SubRaceCode::DARK;

    /**
     * @return DarkElf|Elf
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::DARK));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::DARK);
    }

}