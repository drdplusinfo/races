<?php
namespace DrdPlus\Races\Orcs;

class Goblin extends Orc
{
    const GOBLIN = 'goblin';

    public static function getIt()
    {
        return parent::getItBySubrace(self::GOBLIN);
    }

    public function getSubraceCode()
    {
        return self::GOBLIN;
    }

}
