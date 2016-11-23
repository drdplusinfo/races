<?php
namespace DrdPlus\Tests\Races;

use Drd\Genders\Female;
use Drd\Genders\Gender;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCode;
use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Races\Dwarfs\CommonDwarf;
use DrdPlus\Races\Race;
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

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $subraceClass);
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

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $namespace);
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
        foreach ($this->getGenders() as $gender) {
            foreach ($this->getBasePropertyCodes() as $propertyCode) {
                $sameValueByGenericGetter = $race->getProperty($propertyCode, $gender, $tables);
                $sameValueByBasePropertyGenericGetter = $race->getBaseProperty($propertyCode, $gender, $tables);
                switch ($propertyCode) {
                    case PropertyCode::STRENGTH :
                        $value = $race->getStrength($gender, $tables);
                        break;
                    case PropertyCode::AGILITY :
                        $value = $race->getAgility($gender, $tables);
                        break;
                    case PropertyCode::KNACK :
                        $value = $race->getKnack($gender, $tables);
                        break;
                    case PropertyCode::WILL :
                        $value = $race->getWill($gender, $tables);
                        break;
                    case PropertyCode::INTELLIGENCE :
                        $value = $race->getIntelligence($gender, $tables);
                        break;
                    case PropertyCode::CHARISMA :
                        $value = $race->getCharisma($gender, $tables);
                        break;
                    default :
                        $value = null;
                }
                self::assertSame(
                    $this->getExpectedBaseProperty($gender->getValue(), $propertyCode),
                    $value,
                    "Unexpected {$gender} $propertyCode"
                );
                self::assertSame($sameValueByGenericGetter, $value);
                self::assertSame($sameValueByBasePropertyGenericGetter, $value);
            }
        }
    }

    /**
     * @return array|Gender[]
     */
    private function getGenders()
    {
        return [
            Male::getIt(),
            Female::getIt(),
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
        /** @var Gender $gender */
        $gender = \Mockery::mock(Gender::class);
        $race->getProperty('invalid code', $gender, $tables);
    }

    /**
     * @test
     * @depends I_can_get_race
     *
     * @param Race $race
     */
    public function I_can_get_non_base_property(Race $race)
    {
        $tables = new Tables();
        $racesTable = $tables->getRacesTable();
        $distanceTable = $tables->getDistanceTable();
        foreach ($this->getGenders() as $gender) {
            foreach ($this->getNonBasePropertyCodes() as $propertyCode) {
                $sameValueByGenericGetter = $race->getProperty($propertyCode, $gender, $tables);
                switch ($propertyCode) {
                    case PropertyCode::SENSES :
                        $value = $race->getSenses($racesTable);
                        break;
                    case PropertyCode::TOUGHNESS :
                        $value = $race->getToughness($racesTable);
                        break;
                    case PropertyCode::SIZE :
                        $value = $race->getSize($gender, $tables);
                        break;
                    case PropertyCode::WEIGHT_IN_KG :
                        $value = $race->getWeightInKg($gender, $tables);
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
                    default :
                        $value = null;
                }
                self::assertSame(
                    $this->getExpectedOtherProperty($propertyCode, $gender->getValue()),
                    $value,
                    "Unexpected {$propertyCode} of {$gender} {$race->getSubraceCode()} {$race->getRaceCode()}"
                );
                self::assertSame($sameValueByGenericGetter, $value);
            }
        }
    }

    private function getNonBasePropertyCodes()
    {
        return [
            PropertyCode::SENSES,
            PropertyCode::TOUGHNESS,
            PropertyCode::SIZE,
            PropertyCode::WEIGHT_IN_KG,
            PropertyCode::HEIGHT_IN_CM,
            PropertyCode::HEIGHT,
            PropertyCode::INFRAVISION,
            PropertyCode::NATIVE_REGENERATION,
            PropertyCode::REQUIRES_DM_AGREEMENT,
            PropertyCode::REMARKABLE_SENSE,
        ];
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
        /** @var Gender $gender */
        $gender = $this->mockery(Gender::class);

        $subrace->getBaseProperty($nonBasePropertyCode, $gender, new Tables());
    }

    /**
     * @return string[][]
     */
    public function provideNonBasePropertyCode()
    {
        return array_map(function ($code) {
            return [$code];
        }, $this->getNonBasePropertyCodes());
    }
}