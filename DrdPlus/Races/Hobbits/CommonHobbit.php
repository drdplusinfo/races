<?php
namespace DrdPlus\Races\Hobbits;

class CommonHobbit extends Hobbit
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
