<?php
namespace DrdPlus\Races\Krolls;

class WildKroll extends Kroll
{
    const WILD = 'wild';

    public static function getIt()
    {
        return parent::getItBySubrace(self::WILD);
    }

    public function getSubraceCode()
    {
        return self::WILD;
    }
}
