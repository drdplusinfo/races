<?php
namespace DrdPlus\Races\Dwarfs;

class CommonDwarf extends Dwarf
{
    const COMMON = 'common';

    /**
     * @return static
     */
    public static function getIt()
    {
        return parent::getIt(self::COMMON);
    }

    public function getSubraceCode()
    {
        return self::COMMON;
    }

}
