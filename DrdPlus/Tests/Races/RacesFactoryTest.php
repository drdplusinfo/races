<?php
namespace DrdPlus\Tests\Races;

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
use DrdPlus\Races\RacesFactory;

class RacesFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @dataProvider provideSubraceCodesAndClass
     * @param string $raceCode
     * @param string $subraceCode
     * @param string $expectedSubraceClass
     */
    public function I_can_create_subrace_by_its_codes($raceCode, $subraceCode, $expectedSubraceClass)
    {
        $subrace = RacesFactory::getSubRaceByCodes($raceCode, $subraceCode);
        self::assertInstanceOf($expectedSubraceClass, $subrace);
        self::assertSame($raceCode, $subrace->getRaceCode());
        self::assertSame($subraceCode, $subrace->getSubraceCode());
    }

    public function provideSubraceCodesAndClass()
    {
        return [
            ['dwarf', 'common', CommonDwarf::class],
            ['dwarf', 'mountain', MountainDwarf::class],
            ['dwarf', 'wood', WoodDwarf::class],
            ['elf', 'common', CommonElf::class],
            ['elf', 'dark', DarkElf::class],
            ['elf', 'green', GreenElf::class],
            ['hobbit', 'common', CommonHobbit::class],
            ['human', 'common', CommonHuman::class],
            ['human', 'highlander', Highlander::class],
            ['kroll', 'common', CommonKroll::class],
            ['kroll', 'wild', WildKroll::class],
            ['orc', 'common', CommonOrc::class],
            ['orc', 'goblin', Goblin::class],
            ['orc', 'skurut', Skurut::class],
        ];
    }

    /**
     * @test
     * @expectedException \DrdPlus\Races\Exceptions\UnknownRaceCode
     * @expectedExceptionMessageRegExp ~dragonius.+drunkalius~
     */
    public function I_can_not_create_subrace_by_unknown_codes()
    {
        RacesFactory::getSubRaceByCodes('dragonius', 'drunkalius');
    }

    /**
     * @test
     * @dataProvider provideInvalidCodePair
     * @expectedException \DrdPlus\Races\Exceptions\InvalidRaceCode
     *
     * @param string $raceCode
     * @param string $subRaceCode
     */
    public function I_can_not_create_subrace_by_non_to_string_value($raceCode, $subRaceCode)
    {
        RacesFactory::getSubRaceByCodes($raceCode, $subRaceCode);
    }

    public function provideInvalidCodePair()
    {
        return [
            ['human', []],
            [[], 'common'],
        ];
    }
}
