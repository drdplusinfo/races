<?php
namespace DrdPlus\Tests\Races\EnumTypes;

use Doctrine\DBAL\Types\Type;
use DrdPlus\Races\Dwarfs\CommonDwarf;
use DrdPlus\Races\Dwarfs\MountainDwarf;
use DrdPlus\Races\Dwarfs\WoodDwarf;
use DrdPlus\Races\Elfs\CommonElf;
use DrdPlus\Races\Elfs\DarkElf;
use DrdPlus\Races\Elfs\GreenElf;
use DrdPlus\Races\EnumTypes\RacesEnumRegistrar;
use DrdPlus\Races\EnumTypes\RaceType;
use DrdPlus\Races\Hobbits\CommonHobbit;
use DrdPlus\Races\Humans\CommonHuman;
use DrdPlus\Races\Humans\Highlander;
use DrdPlus\Races\Krolls\CommonKroll;
use DrdPlus\Races\Krolls\WildKroll;
use DrdPlus\Races\Orcs\CommonOrc;
use DrdPlus\Races\Orcs\Goblin;
use DrdPlus\Races\Orcs\Skurut;
use Granam\Tests\Tools\TestWithMockery;

class RacesEnumRegistrarTest extends TestWithMockery
{

    /**
     * @test
     */
    public function I_can_register_all_the_races_at_once()
    {
        RacesEnumRegistrar::registerAll();

        self::assertTrue(Type::hasType(RaceType::RACE));

        self::assertTrue(RaceType::hasSubTypeEnum(CommonDwarf::class));
        self::assertTrue(RaceType::hasSubTypeEnum(MountainDwarf::class));
        self::assertTrue(RaceType::hasSubTypeEnum(WoodDwarf::class));

        self::assertTrue(RaceType::hasSubTypeEnum(CommonElf::class));
        self::assertTrue(RaceType::hasSubTypeEnum(DarkElf::class));
        self::assertTrue(RaceType::hasSubTypeEnum(GreenElf::class));

        self::assertTrue(RaceType::hasSubTypeEnum(CommonHobbit::class));

        self::assertTrue(RaceType::hasSubTypeEnum(CommonHuman::class));
        self::assertTrue(RaceType::hasSubTypeEnum(Highlander::class));

        self::assertTrue(RaceType::hasSubTypeEnum(CommonKroll::class));
        self::assertTrue(RaceType::hasSubTypeEnum(WildKroll::class));

        self::assertTrue(RaceType::hasSubTypeEnum(CommonOrc::class));
        self::assertTrue(RaceType::hasSubTypeEnum(Goblin::class));
        self::assertTrue(RaceType::hasSubTypeEnum(Skurut::class));
    }
}
