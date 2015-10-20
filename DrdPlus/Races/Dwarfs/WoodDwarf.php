<?php
namespace DrdPlus\Races\Dwarfs;

class WoodDwarf extends Dwarf
{
    const WOOD = 'wood';

    /**
     * @return static
     */
    public static function getIt()
    {
        return parent::getItBySubrace(self::WOOD);
    }

    public function getSubraceCode()
    {
        return self::WOOD;
    }

}
