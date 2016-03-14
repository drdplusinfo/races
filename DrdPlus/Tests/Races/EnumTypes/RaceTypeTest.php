<?php
namespace DrdPlus\Races;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use DrdPlus\Races\EnumTypes\RaceType;
use Granam\Tests\Tools\TestWithMockery;;

class RaceTypeTest extends TestWithMockery
{

    /**
     * @test
     */
    public function I_can_get_type_name()
    {
        self::assertSame('race', RaceType::getTypeName());
        self::assertSame(RaceType::RACE, RaceType::getTypeName());
    }

    /**
     * @test
     * @depends I_can_get_type_name
     */
    public function I_can_register_it_by_self()
    {
        RaceType::registerSelf();
        self::assertTrue(Type::hasType(RaceType::getTypeName()));
        $raceType = Type::getType(RaceType::getTypeName());
        self::assertInstanceOf(RaceType::class, $raceType);
    }

    /**
     * @test
     * @depends I_can_register_it_by_self
     */
    public function I_can_register_subrace()
    {
        $testSubrace = new TestSubrace('foo-bar');
        self::assertTrue(RaceType::registerRaceAsSubType($testSubrace));

        $raceType = Type::getType(RaceType::getTypeName());
        $databaseValue = $raceType->convertToDatabaseValue($testSubrace, $this->getPlatform());
        $expectedDatabaseValue = "{$testSubrace->getRaceCode()}-{$testSubrace->getSubraceCode()}";
        self::assertSame($expectedDatabaseValue, $databaseValue);

        $restoredSubrace = $raceType->convertToPHPValue($expectedDatabaseValue, $this->getPlatform());
        self::assertEquals($testSubrace, $restoredSubrace);
    }

    /**
     * @test
     * @depends I_can_register_subrace
     * @expectedException \DrdPlus\Races\Exceptions\UnexpectedRaceCode
     */
    public function I_can_not_use_unexpected_race_enum_code()
    {
        new TestSubrace('unexpected');
    }

    /**
     * @return AbstractPlatform
     */
    protected function getPlatform()
    {
        return \Mockery::mock(AbstractPlatform::class);
    }

}

/** inner */
class TestSubrace extends Race
{

    public function getRaceCode()
    {
        return 'foo';
    }

    public function getSubraceCode()
    {
        return 'bar';
    }
}
