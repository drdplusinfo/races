<?php
namespace DrdPlus\Races\Dwarfs;

class MountainDwarf extends Dwarf
{

    const MOUNTAIN = 'mountain';

    /**
     * @return static
     */
    public static function getIt()
    {
        return parent::getItBySubrace(self::MOUNTAIN);
    }

    public function getSubraceCode()
    {
        return self::MOUNTAIN;
    }

}
