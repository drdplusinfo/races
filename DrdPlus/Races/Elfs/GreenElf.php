<?php
namespace DrdPlus\Races\Elfs;

class GreenElf extends Elf
{
    const GREEN = 'green';

    public static function getIt()
    {
        return parent::getIt(self::GREEN);
    }

    public function getSubraceCode()
    {
        return self::GREEN;
    }

}
