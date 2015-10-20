<?php
namespace DrdPlus\Races\Humans;

class CommonHuman extends Human
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
