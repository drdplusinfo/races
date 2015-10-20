<?php
namespace DrdPlus\Races\EnumTypes;

use Doctrine\DBAL\Types\Type;
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
use DrdPlus\Tests\Races\TestWithMockery;

class RaceRegistrarTest extends TestWithMockery
{

    /**
     * @test
     */
    public function I_can_register_all_the_races_at_once()
    {
        RaceRegistrar::registerAll();

        $this->assertTrue(Type::hasType(RaceType::RACE));

        $this->assertTrue(RaceType::hasSubTypeEnum(CommonDwarf::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(MountainDwarf::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(WoodDwarf::class));

        $this->assertTrue(RaceType::hasSubTypeEnum(CommonElf::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(DarkElf::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(GreenElf::class));

        $this->assertTrue(RaceType::hasSubTypeEnum(CommonHobbit::class));

        $this->assertTrue(RaceType::hasSubTypeEnum(CommonHuman::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(Highlander::class));

        $this->assertTrue(RaceType::hasSubTypeEnum(CommonKroll::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(WildKroll::class));

        $this->assertTrue(RaceType::hasSubTypeEnum(CommonOrc::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(Goblin::class));
        $this->assertTrue(RaceType::hasSubTypeEnum(Skurut::class));
    }
}
