<?php
namespace DrdPlus\Races\Dwarfs;

use DrdPlus\Codes\SubRaceCode;

class MountainDwarf extends Dwarf
{

    const MOUNTAIN = SubRaceCode::MOUNTAIN;

    /**
     * @return MountainDwarf|Dwarf
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::MOUNTAIN));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::MOUNTAIN);
    }

}