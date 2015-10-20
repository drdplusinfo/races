<?php
namespace DrdPlus\Races\Orcs;

class CommonOrc extends Orc
{
    const COMMON = 'common';

    public static function getIt()
    {
        return parent::getItBySubrace(self::COMMON);
    }

    public function getSubraceCode()
    {
        return self::COMMON;
    }

}
