<?php
namespace DrdPlus\Races\Elfs;

class CommonElf extends Elf
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
