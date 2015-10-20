<?php
namespace DrdPlus\Races\Elfs;

class CommonElf extends Elf
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
