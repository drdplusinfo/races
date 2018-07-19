<?php
declare(strict_types = 1);

namespace DrdPlus\Races\Elves;

use DrdPlus\Codes\SubRaceCode;

class GreenElf extends Elf
{
    const GREEN = SubRaceCode::GREEN;

    /**
     * @return GreenElf|Elf
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::GREEN));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::GREEN);
    }

}