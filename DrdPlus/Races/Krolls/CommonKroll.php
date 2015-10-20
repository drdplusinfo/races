<?php
namespace DrdPlus\Races\Krolls;

class CommonKroll extends Kroll
{
    const COMMON = 'common';

    public static function getIt()
    {
        return parent::getIt(self::COMMON);
    }

    public function getSubraceCode()
    {
        return self::COMMON;
    }

}
