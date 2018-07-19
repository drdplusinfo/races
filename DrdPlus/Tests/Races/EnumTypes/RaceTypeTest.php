<?php
declare(strict_types = 1);

namespace DrdPlus\Tests\Races\EnumTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrineum\Tests\SelfRegisteringType\AbstractSelfRegisteringTypeTest;
use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
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
        $testSubrace = TestSubrace::getIt();
        self::assertTrue(RaceType::registerRaceAsSubType($testSubrace));

        $raceType = Type::getType($this->getExpectedTypeName());
        $databaseValue = $raceType->convertToDatabaseValue($testSubrace, $this->getPlatform());
        $expectedDatabaseValue = "{$testSubrace->getRaceCode()}-{$testSubrace->getSubraceCode()}";
        self::assertSame($expectedDatabaseValue, $databaseValue);

        $restoredSubrace = $raceType->convertToPHPValue($expectedDatabaseValue, $this->getPlatform());
        self::assertEquals($testSubrace, $restoredSubrace);
    }

    /**
     * @return AbstractPlatform
     */
    protected function getPlatform(): AbstractPlatform
    {
        return \Mockery::mock(AbstractPlatform::class);
    }

}

/** inner */
class TestSubrace extends Race
{

    public static function getIt()
    {
        return parent::getItByRaceAndSubrace(self::getLocalRaceCode(), self::getLocalSubraceCode());
    }

    private static $raceCode;

    /**
     * @return \Mockery\MockInterface|RaceCode
     */
    private static function getLocalRaceCode()
    {
        if (self::$raceCode === null) {
            self::$raceCode = \Mockery::mock(RaceCode::class);
            self::$raceCode->shouldReceive('getValue')
                ->andReturn('foo');
        }

        return self::$raceCode;
    }

    private static $subraceCode;

    /**
     * @return \Mockery\MockInterface|SubRaceCode
     */
    private static function getLocalSubraceCode()
    {
        if (self::$subraceCode === null) {
            self::$subraceCode = \Mockery::mock(SubRaceCode::class);
            self::$subraceCode->shouldReceive('getValue')
                ->andReturn('bar');
        }

        return self::$subraceCode;
    }

    public function getRaceCode()
    {
        return self::getLocalRaceCode();
    }

    public function getSubraceCode()
    {
        return self::getLocalSubraceCode();
    }
}