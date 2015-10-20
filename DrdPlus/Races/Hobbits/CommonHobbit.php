<?php
namespace DrdPlus\Races\Hobbits;

class CommonHobbit extends Hobbit
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
