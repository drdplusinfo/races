<?php
namespace DrdPlus\Races\Dwarfs;

use DrdPlus\Codes\SubRaceCode;

class WoodDwarf extends Dwarf
{
    const WOOD = SubRaceCode::WOOD;

    /**
     * @return WoodDwarf|Dwarf
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::WOOD));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::WOOD);
    }

}