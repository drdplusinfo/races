<?php
namespace DrdPlus\Races\Krolls;

class CommonKroll extends Kroll
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
