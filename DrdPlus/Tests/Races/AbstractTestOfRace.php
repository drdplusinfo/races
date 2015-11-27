<?php
namespace DrdPlus\Tests\Races;

use Drd\Genders\Female;
use Drd\Genders\Gender;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Races\Dwarfs\CommonDwarf;
use DrdPlus\Races\Race;
use DrdPlus\Tables\Measurements\Weight\WeightTable;
use DrdPlus\Tables\Races\FemaleModifiersTable;
use DrdPlus\Tables\Races\RacesTable;

abstract class AbstractTestOfRace extends TestWithMockery
{
    /**
     * @test
     * @return Race
     */
    public function I_can_get_race()
    {
        $subraceClass = $this->getSubraceClass();
        $subrace = $subraceClass::getIt();
        $this->assertInstanceOf($subraceClass, $subrace);
        $this->assertSame($this->getRaceCode(), $subrace->getRaceCode());
        $this->assertSame($this->getSubraceCode(), $subrace->getSubraceCode());

        return $subrace;
    }

    /**
     * @return string|Race|CommonDwarf
     */
    protected function getSubraceClass()
    {
        return preg_replace('~[\\\]Tests(.+)Test$~', '$1', static::class);
    }

    /**
     * @return string
     */
    protected function getSubraceCode()
    {
        $subraceCode = str_replace($this->getRaceCode(), '', strtolower($this->getSubraceBaseName()));

        return $subraceCode;
    }

    /**
     * @return string
     */
    protected function getSubraceBaseName()
    {
        $subraceClass = $this->getSubraceClass();

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $subraceClass);
    }

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        $baseNamespace = $this->getSubraceBaseNamespace();
        $singular = preg_replace('~s$~', '', $baseNamespace);

        return strtolower($singular);
    }

    protected function getSubraceBaseNamespace()
    {
        $namespace = $this->getSubraceNamespace();

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $namespace);
    }

    protected function getSubraceNamespace()
    {
        $subraceClass = $this->getSubraceClass();

        return preg_replace('~\\\[\w]+$~', '', $subraceClass);
    }

    /**
     * @test
     * @depends I_can_get_race
     *
     * @param Race $race
     */
    public function I_can_get_body_property(Race $race)
    {
        $racesTable = new RacesTable();
        $femaleModifiersTable = new FemaleModifiersTable();
        foreach ($this->getGenders() as $gender) {
            foreach ($this->getPropertyCodes() as $propertyCode) {
                switch ($propertyCode) {
                    case PropertyCodes::STRENGTH :
                        $value = $race->getStrength($racesTable, $gender, $femaleModifiersTable);
                        break;
                    case PropertyCodes::AGILITY :
                        $value = $race->getAgility($racesTable, $gender, $femaleModifiersTable);
                        break;
                    case PropertyCodes::KNACK :
                        $value = $race->getKnack($racesTable, $gender, $femaleModifiersTable);
                        break;
                    case PropertyCodes::WILL :
                        $value = $race->getWill($racesTable, $gender, $femaleModifiersTable);
                        break;
                    case PropertyCodes::INTELLIGENCE :
                        $value = $race->getIntelligence($racesTable, $gender, $femaleModifiersTable);
                        break;
                    case PropertyCodes::CHARISMA :
                        $value = $race->getCharisma($racesTable, $gender, $femaleModifiersTable);
                        break;
                    default :
                        $value = null;
                }
                $this->assertSame(
                    $this->getExpectedBodyProperty($gender->getEnumValue(), $propertyCode),
                    $value,
                    "Unexpected {$gender} $propertyCode"
                );
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
    private function getPropertyCodes()
    {
        return [
            PropertyCodes::STRENGTH,
            PropertyCodes::AGILITY,
            PropertyCodes::KNACK,
            PropertyCodes::WILL,
            PropertyCodes::INTELLIGENCE,
            PropertyCodes::CHARISMA,
        ];
    }

    /**
     * @param string $genderCode
     * @param string $propertyCode
     *
     * @return int
     */
    abstract protected function getExpectedBodyProperty($genderCode, $propertyCode);

    /**
     * @test
     * @depends I_can_get_race
     *
     * @param Race $race
     */
    public function I_can_get_other_property(Race $race)
    {
        $racesTable = new RacesTable();
        $femaleModifiersTable = new FemaleModifiersTable();
        $weightTable = new WeightTable();
        foreach ($this->getGenders() as $gender) {
            foreach ($this->getOtherPropertyCodes() as $propertyCode) {
                switch ($propertyCode) {
                    case PropertyCodes::SENSES :
                        $value = $race->getSenses($racesTable);
                        break;
                    case PropertyCodes::TOUGHNESS :
                        $value = $race->getToughness($racesTable);
                        break;
                    case PropertyCodes::SIZE :
                        $value = $race->getSize($racesTable, $gender, $femaleModifiersTable);
                        break;
                    case PropertyCodes::WEIGHT_IN_KG :
                        $value = $race->getWeightInKg($racesTable, $gender, $femaleModifiersTable, $weightTable);
                        break;
                    case PropertyCodes::HEIGHT_IN_CM :
                        $value = $race->getHeightInCm($racesTable);
                        break;
                    case PropertyCodes::INFRAVISION :
                        $value = $race->hasInfravision($racesTable);
                        break;
                    case PropertyCodes::NATIVE_REGENERATION :
                        $value = $race->hasNativeRegeneration($racesTable);
                        break;
                    case PropertyCodes::REQUIRES_DM_AGREEMENT :
                        $value = $race->requiresDmAgreement($racesTable);
                        break;
                    case PropertyCodes::REMARKABLE_SENSE :
                        $value = $race->getRemarkableSense($racesTable);
                        break;
                    default :
                        $value = null;
                }
                $this->assertSame(
                    $this->getExpectedOtherProperty($propertyCode, $gender->getEnumValue()),
                    $value,
                    "Unexpected {$gender} $propertyCode"
                );
            }
        }
    }

    private function getOtherPropertyCodes()
    {
        return [
            PropertyCodes::SENSES,
            PropertyCodes::TOUGHNESS,
            PropertyCodes::SIZE,
            PropertyCodes::WEIGHT_IN_KG,
            PropertyCodes::HEIGHT_IN_CM,
            PropertyCodes::INFRAVISION,
            PropertyCodes::NATIVE_REGENERATION,
            PropertyCodes::REQUIRES_DM_AGREEMENT,
            PropertyCodes::REMARKABLE_SENSE,
        ];
    }

    /**
     * @param string $propertyCode
     * @param string $genderCode
     * @return int|float|bool|string
     */
    abstract protected function getExpectedOtherProperty($propertyCode, $genderCode);
}