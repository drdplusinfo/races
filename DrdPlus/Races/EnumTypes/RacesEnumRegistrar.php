<?php
namespace DrdPlus\Races\EnumTypes;

use DrdPlus\Races\Dwarfs\CommonDwarf;
use DrdPlus\Races\Dwarfs\MountainDwarf;
use DrdPlus\Races\Dwarfs\WoodDwarf;
use DrdPlus\Races\Elfs\CommonElf;
use DrdPlus\Races\Elfs\DarkElf;
use DrdPlus\Races\Elfs\GreenElf;
use DrdPlus\Races\Hobbits\CommonHobbit;
use DrdPlus\Races\Humans\CommonHuman;
use DrdPlus\Races\Humans\Highlander;
use DrdPlus\Races\Krolls\CommonKroll;
use DrdPlus\Races\Krolls\WildKroll;
use DrdPlus\Races\Orcs\CommonOrc;
use DrdPlus\Races\Orcs\Goblin;
use DrdPlus\Races\Orcs\Skurut;
use Granam\Strict\Object\StrictObject;

class RacesEnumRegistrar extends StrictObject
{
    public static function registerAll()
    {
        RaceType::registerSelf();

        RaceType::registerRaceAsSubType(CommonDwarf::getIt());
        RaceType::registerRaceAsSubType(MountainDwarf::getIt());
        RaceType::registerRaceAsSubType(WoodDwarf::getIt());

        RaceType::registerRaceAsSubType(CommonElf::getIt());
        RaceType::registerRaceAsSubType(DarkElf::getIt());
        RaceType::registerRaceAsSubType(GreenElf::getIt());

        RaceType::registerRaceAsSubType(CommonElf::getIt());
        RaceType::registerRaceAsSubType(DarkElf::getIt());
        RaceType::registerRaceAsSubType(GreenElf::getIt());

        RaceType::registerRaceAsSubType(CommonHobbit::getIt());

        RaceType::registerRaceAsSubType(CommonHuman::getIt());
        RaceType::registerRaceAsSubType(Highlander::getIt());

        RaceType::registerRaceAsSubType(CommonKroll::getIt());
        RaceType::registerRaceAsSubType(WildKroll::getIt());

        RaceType::registerRaceAsSubType(CommonOrc::getIt());
        RaceType::registerRaceAsSubType(Goblin::getIt());
        RaceType::registerRaceAsSubType(Skurut::getIt());
    }
}
