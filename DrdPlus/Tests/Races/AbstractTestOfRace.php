<?php
namespace DrdPlus\Tests\Races;

use Drd\Genders\Female;
use Drd\Genders\Gender;
use Drd\Genders\Male;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Races\Dwarfs\CommonDwarf;
use DrdPlus\Races\Race;
use DrdPlus\Tables\Races\FemaleModifiersTable;
use DrdPlus\Tables\Races\RacesTable;

abstract class AbstractTestOfRace extends TestWithMockery
{
    /**
     * @test
     * @return Race
     */
    public function I_can_get_subrace()
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
     * @depends I_can_get_subrace
     *
     * @param Race $race
     */
    public function I_can_get_body_property(Race $race)
    {
        $racesTable = new RacesTable();
        $femaleModifiersTable = new FemaleModifiersTable();
        foreach ($this->getGenders() as $gender) {
            foreach ($this->getPropertyCodes() as $propertyCode) {
                $getProperty = 'get' . ucfirst($propertyCode);
                $this->assertSame(
                    $this->getExpectedBodyProperty($gender->getEnumValue(), $propertyCode),
                    $race->$getProperty($gender, $racesTable, $femaleModifiersTable),
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
     * @depends I_can_get_subrace
     *
     * @param Race $race
     */
    public function I_can_get_other_property(Race $race)
    {
        $racesTable = new RacesTable();
        $femaleModifiersTable = new FemaleModifiersTable();
        foreach ($this->getOtherPropertyCodes() as $propertyCode => $getProperty) {
            $this->assertSame(
                $this->getExpectedOtherProperty($propertyCode),
                $race->$getProperty($racesTable, $femaleModifiersTable),
                "Unexpected $propertyCode"
            );
        }
    }

    private function getOtherPropertyCodes()
    {
        return [
            PropertyCodes::SENSES => 'getSenses',
            PropertyCodes::TOUGHNESS => 'getToughness',
            PropertyCodes::SIZE => 'getSize',
            PropertyCodes::WEIGHT_IN_KG => 'getWeightInKg',
            PropertyCodes::HEIGHT_IN_CM => 'getHeightInCm',
            PropertyCodes::INFRAVISION => 'hasInfravision',
            PropertyCodes::NATIVE_REGENERATION => 'hasNativeRegeneration',
            PropertyCodes::REQUIRES_DM_AGREEMENT => 'requiresDmAgreement',
        ];
    }

    /**
     * @param string $propertyCode
     * @return int|float|bool
     */
    abstract protected function getExpectedOtherProperty($propertyCode);

    /**
     * @test
     * @depends I_can_get_subrace
     *
     * @param Race $race
     */
    public function I_can_get_remarkable_sense(Race $race)
    {
        $this->assertSame(
            $this->getExpectedRemarkableSense(),
            $race->getRemarkableSense(new RacesTable())
        );
    }

    /**
     * @return string|false
     */
    abstract protected function getExpectedRemarkableSense();

}
