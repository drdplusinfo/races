<?php
namespace DrdPlus\Tests\Races\EnumTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrineum\Tests\SelfRegisteringType\AbstractSelfRegisteringTypeTest;
use DrdPlus\Races\EnumTypes\RaceType;
use DrdPlus\Races\Race;

class RaceTypeTest extends AbstractSelfRegisteringTypeTest
{

    /**
     * @test
     */
    public function I_can_register_subrace()
    {
        RaceType::registerSelf();
        $testSubrace = new TestSubrace('foo-bar');
        self::assertTrue(RaceType::registerRaceAsSubType($testSubrace));

        $raceType = Type::getType($this->getExpectedTypeName());
        $databaseValue = $raceType->convertToDatabaseValue($testSubrace, $this->getPlatform());
        $expectedDatabaseValue = "{$testSubrace->getRaceCode()}-{$testSubrace->getSubraceCode()}";
        self::assertSame($expectedDatabaseValue, $databaseValue);

        $restoredSubrace = $raceType->convertToPHPValue($expectedDatabaseValue, $this->getPlatform());
        self::assertEquals($testSubrace, $restoredSubrace);
    }

    /**
     * @test
     * @depends I_can_register_subrace
     * @expectedException \DrdPlus\Races\Exceptions\UnknownRaceCode
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
