<?php
namespace DrdPlus\Tests\Races;

use DrdPlus\Codes\GenderCode;
use DrdPlus\Codes\PropertyCode;
use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Dwarfs\CommonDwarf;
use DrdPlus\Races\Race;
use DrdPlus\Tables\Measurements\Weight\Weight;
use DrdPlus\Tables\Measurements\Weight\WeightTable;
use DrdPlus\Tables\Tables;
use Granam\Tests\Tools\TestWithMockery;

abstract class RaceTest extends TestWithMockery
{
    /**
     * @test
     * @return Race
     */
    public function I_can_get_race()
    {
        $subraceClass = $this->getSubraceClass();
        $subrace = $subraceClass::getIt();
        self::assertInstanceOf($subraceClass, $subrace);
        self::assertSame($this->getRaceCode(), $subrace->getRaceCode());
        self::assertSame($this->getSubraceCode(), $subrace->getSubraceCode());
        self::assertSame($subrace, $subraceClass::getEnum($this->getRaceCode() . '-' . $subrace->getSubraceCode()));

        return $subrace;
    }

    /**
     * @return string|Race|CommonDwarf
     */
    private function getSubraceClass()
    {
        return preg_replace('~[\\\]Tests(.+)Test$~', '$1', static::class);
    }

    /**
     * @return SubRaceCode
     */
    private function getSubraceCode()
    {
        $subraceCodeString = str_replace($this->getRaceCode(), '', strtolower($this->getSubraceBaseName()));

        return SubRaceCode::getIt($subraceCodeString);
    }

    /**
     * @return string
     */
    private function getSubraceBaseName()
    {
        $subraceClass = $this->getSubraceClass();

        return preg_replace('~(\w+\\\){0,5}(\w+)~', '$2', $subraceClass);
    }

    /**
     * @return RaceCode
     */
    private function getRaceCode()
    {
        $baseNamespace = $this->getSubraceBaseNamespace();
        if (preg_match('~ves$~', $baseNamespace)) {
            $singular = preg_replace('~ves$~', 'f', $baseNamespace);
        } else {
            $singular = preg_replace('~s$~', '', $baseNamespace);
        }

        return RaceCode::getIt(strtolower($singular));
    }

    /**
     * @return string
     */
    private function getSubraceBaseNamespace()
    {
        $namespace = $this->getSubraceNamespace();

        return preg_replace('~(\w+\\\){0,5}(\w+)~', '$2', $namespace);
    }

    /**
     * @return string
     */
    private function getSubraceNamespace()
    {
        $subraceClass = $this->getSubraceClass();

        return preg_replace('~\\\[\w]+$~', '', $subraceClass);
    }

    /**
     * @test
     * @expectedException \DrdPlus\Races\Exceptions\UnknownRaceCode
     */
    public function I_can_not_create_it_by_enum_factory_method_with_invalid_code()
    {
        $subraceClass = $this->getSubraceClass();
        $subraceClass::getEnum('foo');
    }

    /**
     * @test
     * @depends I_can_get_race
     *
     * @param Race $race
     */
    public function I_can_get_base_property(Race $race)
    {
        $tables = new Tables();
        foreach ($this->getGenders() as $genderCode) {
            foreach ($this->getBasePropertyCodes() as $propertyCode) {
                $sameValueByGenericGetter = $race->getProperty($propertyCode, $genderCode, $tables);
                $sameValueByBasePropertyGenericGetter = $race->getBaseProperty($propertyCode, $genderCode, $tables);
                switch ($propertyCode) {
                    case PropertyCode::STRENGTH :
                        $value = $race->getStrength($genderCode, $tables);
                        break;
                    case PropertyCode::AGILITY :
                        $value = $race->getAgility($genderCode, $tables);
                        break;
                    case PropertyCode::KNACK :
                        $value = $race->getKnack($genderCode, $tables);
                        break;
                    case PropertyCode::WILL :
                        $value = $race->getWill($genderCode, $tables);
                        break;
                    case PropertyCode::INTELLIGENCE :
                        $value = $race->getIntelligence($genderCode, $tables);
                        break;
                    case PropertyCode::CHARISMA :
                        $value = $race->getCharisma($genderCode, $tables);
                        break;
                    default :
                        $value = null;
                }
                self::assertSame(
                    $this->getExpectedBaseProperty($genderCode->getValue(), $propertyCode),
                    $value,
                    "Unexpected {$genderCode} $propertyCode"
                );
                self::assertSame($sameValueByGenericGetter, $value);
                self::assertSame($sameValueByBasePropertyGenericGetter, $value);
            }
        }
    }

    /**
     * @return array|GenderCode[]
     */
    private function getGenders()
    {
        return [
            GenderCode::getIt(GenderCode::MALE),
            GenderCode::getIt(GenderCode::FEMALE),
        ];
    }

    /**
     * @return array|string[]
     */
    private function getBasePropertyCodes()
    {
        return [
            PropertyCode::STRENGTH,
            PropertyCode::AGILITY,
            PropertyCode::KNACK,
            PropertyCode::WILL,
            PropertyCode::INTELLIGENCE,
            PropertyCode::CHARISMA,
        ];
    }

    /**
     * @param string $genderCode
     * @param string $propertyCode
     *
     * @return int
     */
    abstract protected function getExpectedBaseProperty($genderCode, $propertyCode);

    /**
     * @test
     * @depends I_can_get_race
     * @expectedException \DrdPlus\Races\Exceptions\UnknownPropertyCode
     *
     * @param Race $race
     */
    public function I_can_not_get_property_by_its_invalid_code(Race $race)
    {
        $tables = new Tables();
        /** @var GenderCode $genderCode */
        $genderCode = \Mockery::mock(GenderCode::class);
        $race->getProperty('invalid code', $genderCode, $tables);
    }

    /**
     * @test
     * @depends I_can_get_race
     * @param Race $race
     * @throws \LogicException
     */
    public function I_can_get_non_base_property(Race $race)
    {
        $tables = new Tables();
        $racesTable = $tables->getRacesTable();
        $distanceTable = $tables->getDistanceTable();
        foreach ($this->getGenders() as $genderCode) {
            foreach ($this->getNonBaseNonDerivedPropertyCodes() as $propertyCode) {
                $sameValueByGenericGetter = $race->getProperty($propertyCode, $genderCode, $tables);
                switch ($propertyCode) {
                    case PropertyCode::SENSES :
                        $value = $race->getSenses($racesTable);
                        break;
                    case PropertyCode::TOUGHNESS :
                        $value = $race->getToughness($racesTable);
                        break;
                    case PropertyCode::SIZE :
                        $value = $race->getSize($genderCode, $tables);
                        break;
                    case PropertyCode::WEIGHT :
                        $value = $race->getWeight($genderCode, $tables);
                        break;
                    case PropertyCode::WEIGHT_IN_KG :
                        $value = $race->getWeightInKg($genderCode, $tables);
                        break;
                    case PropertyCode::HEIGHT_IN_CM :
                        $value = $race->getHeightInCm($racesTable);
                        break;
                    case PropertyCode::HEIGHT :
                        $value = $race->getHeight($racesTable, $distanceTable);
                        break;
                    case PropertyCode::INFRAVISION :
                        $value = $race->hasInfravision($racesTable);
                        break;
                    case PropertyCode::NATIVE_REGENERATION :
                        $value = $race->hasNativeRegeneration($racesTable);
                        break;
                    case PropertyCode::REQUIRES_DM_AGREEMENT :
                        $value = $race->requiresDmAgreement($racesTable);
                        break;
                    case PropertyCode::REMARKABLE_SENSE :
                        $value = $race->getRemarkableSense($racesTable);
                        break;
                    case PropertyCode::AGE :
                        $value = $race->getAge($racesTable);
                        break;
                    default :
                        throw new \LogicException(
                            "Unexpected property {$propertyCode} for {$race->getSubraceCode()} {$race->getRaceCode()} {$genderCode}"
                        );
                }
                if ($propertyCode === PropertyCode::WEIGHT) {
                    $expectedOtherProperty = $this->getExpectedWeight($genderCode, $tables->getWeightTable());
                } else {
                    $expectedOtherProperty = $this->getExpectedOtherProperty($propertyCode, $genderCode->getValue());
                }
                self::assertEquals(
                    $expectedOtherProperty,
                    $value,
                    "Unexpected {$propertyCode} of {$race->getSubraceCode()} {$race->getRaceCode()} {$genderCode}"
                );
                self::assertSame($sameValueByGenericGetter, $value);
            }
        }
    }

    /**
     * @return array|string[]
     */
    private function getNonBaseNonDerivedPropertyCodes()
    {
        return array_diff(
            PropertyCode::getPossibleValues(),
            PropertyCode::getBasePropertyPossibleValues(),
            PropertyCode::getDerivedPropertyPossibleValues(), // exclude derived properties
            PropertyCode::getRemarkableSensePropertyPossibleValues() // those are just values of a remarkable sense
        );
    }

    /**
     * @param GenderCode $genderCode
     * @param WeightTable $weightTable
     * @return float
     */
    private function getExpectedWeight(GenderCode $genderCode, WeightTable $weightTable)
    {
        return (new Weight(
            $this->getExpectedOtherProperty(PropertyCode::WEIGHT_IN_KG, $genderCode->getValue()),
            Weight::KG,
            $weightTable
        ))->getValue();
    }

    /**
     * @param string $propertyCode
     * @param string $genderCode
     * @return int|float|bool|string
     */
    abstract protected function getExpectedOtherProperty($propertyCode, $genderCode);

    /**
     * @test
     * @dataProvider provideNonBasePropertyCode
     * @expectedException \DrdPlus\Races\Exceptions\UnknownBasePropertyCode
     *
     * @param string $nonBasePropertyCode
     */
    public function I_can_not_get_non_base_property_by_base_getter($nonBasePropertyCode)
    {
        $subraceClass = $this->getSubraceClass();
        $subrace = $subraceClass::getIt();
        /** @var GenderCode $genderCode */
        $genderCode = $this->mockery(GenderCode::class);

        $subrace->getBaseProperty($nonBasePropertyCode, $genderCode, new Tables());
    }

    /**
     * @return string[][]
     */
    public function provideNonBasePropertyCode()
    {
        return array_map(function ($code) {
            return [$code];
        }, $this->getNonBaseNonDerivedPropertyCodes());
    }
}