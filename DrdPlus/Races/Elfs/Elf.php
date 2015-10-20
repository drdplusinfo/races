<?php
namespace DrdPlus\Races\Elfs;

use DrdPlus\Races\Race;

abstract class Elf extends Race
{
    const ELF = 'elf';

    /**
     * @param string $subraceCode
     * @return static
     */
    protected static function getIt($subraceCode)
    {
        return parent::getIt(self::ELF, $subraceCode);
    }

    public function getRaceCode()
    {
        return self::ELF;
    }

}
