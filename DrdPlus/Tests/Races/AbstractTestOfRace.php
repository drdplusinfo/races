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
        return preg_replace('~Test$~', '', static::class);
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
    public function I_can_get_each_property_for_any_race(Race $race)
    {
        $racesTable = new RacesTable();
        $femaleModifiersTable = new FemaleModifiersTable();
        foreach ($this->getGenders() as $gender) {
            foreach ($this->getPropertyCodes() as $propertyCode) {
                $getProperty = 'get' . ucfirst($propertyCode);
                $this->assertSame(
                    $this->getExpectedProperty(
                        $gender->getEnumValue(),
                        $propertyCode
                    ),
                    $race->$getProperty($gender, $racesTable, $femaleModifiersTable),
                    "Unexpected {$gender} $propertyCode"
                );
            }
        }
    }

    /**
     * @return array|Gender[]
     */
    protected function getGenders()
    {
        return [
            Male::getIt(),
            Female::getIt(),
        ];
    }

    /**
     * @return array|string[]
     */
    protected function getPropertyCodes()
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
    abstract protected function getExpectedProperty($genderCode, $propertyCode);

}
