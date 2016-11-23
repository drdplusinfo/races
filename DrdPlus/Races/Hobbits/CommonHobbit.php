<?php
namespace DrdPlus\Races\Hobbits;

use DrdPlus\Codes\SubRaceCode;

class CommonHobbit extends Hobbit
{
    const COMMON = SubRaceCode::COMMON;

    /**
     * @return Hobbit|CommonHobbit
     */
    public static function getIt()
    {
        return parent::getItBySubrace(SubRaceCode::getIt(self::COMMON));
    }

    /**
     * @return SubRaceCode
     */
    public function getSubraceCode()
    {
        return SubRaceCode::getIt(self::COMMON);
    }
}