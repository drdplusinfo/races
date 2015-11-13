<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\Enum;
use Drd\Genders\Gender;
use DrdPlus\Tables\Races\FemaleModifiersTable;
use DrdPlus\Tables\Races\RacesTable;
use Granam\Scalar\Tools\ValueDescriber;

abstract class Race extends Enum
{

    public function __construct($value)
    {
        parent::__construct($value);
        $this->checkRaceEnumValue($this->getEnumValue());
    }

    private function checkRaceEnumValue($value)
    {
        if ($value !== self::createRaceAndSubraceCode($this->getRaceCode(), $this->getSubraceCode())) {
            throw new Exceptions\UnexpectedRaceValue(
                'Expected ' . self::createRaceAndSubraceCode($this->getRaceCode(), $this->getSubraceCode())
                . ' got ' . ValueDescriber::describe($value)
            );
        }
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     *
     * @return static
     */
    protected static function getItByRaceAndSubrace($raceCode, $subraceCode)
    {
        return self::getEnum(self::createRaceAndSubraceCode($raceCode, $subraceCode));
    }

    private static function createRaceAndSubraceCode($raceCode, $subraceCode)
    {
        return "$raceCode-$subraceCode";
    }

    /**
     * @return string
     */
    abstract public function getRaceCode();

    /**
     * @return string
     */
    abstract public function getSubraceCode();

    /**
     * @param Gender $gender
     * @param RacesTable $racesTable
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getStrength(Gender $gender, RacesTable $racesTable, FemaleModifiersTable $femaleModifiersTable)
    {
        return
            $racesTable->getStrength($this->getRaceCode(), $this->getSubraceCode())
            + ($gender->isFemale()
                ? $femaleModifiersTable->getStrength($this->getRaceCode())
                : 0
            );
    }

    /**
     * @param Gender $gender
     * @param RacesTable $racesTable
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getAgility(Gender $gender, RacesTable $racesTable, FemaleModifiersTable $femaleModifiersTable)
    {
        return
            $racesTable->getAgility($this->getRaceCode(), $this->getSubraceCode())
            + ($gender->isFemale()
                ? $femaleModifiersTable->getAgility($this->getRaceCode())
                : 0
            );
    }

    /**
     * @param Gender $gender
     * @param RacesTable $racesTable
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getKnack(Gender $gender, RacesTable $racesTable, FemaleModifiersTable $femaleModifiersTable)
    {
        return
            $racesTable->getKnack($this->getRaceCode(), $this->getSubraceCode())
            + ($gender->isFemale()
                ? $femaleModifiersTable->getKnack($this->getRaceCode())
                : 0
            );
    }

    /**
     * @param Gender $gender
     * @param RacesTable $racesTable
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getWill(Gender $gender, RacesTable $racesTable, FemaleModifiersTable $femaleModifiersTable)
    {
        return
            $racesTable->getWill($this->getRaceCode(), $this->getSubraceCode())
            + ($gender->isFemale()
                ? $femaleModifiersTable->getWill($this->getRaceCode())
                : 0
            );
    }

    /**
     * @param Gender $gender
     * @param RacesTable $racesTable
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getIntelligence(Gender $gender, RacesTable $racesTable, FemaleModifiersTable $femaleModifiersTable)
    {
        return
            $racesTable->getIntelligence($this->getRaceCode(), $this->getSubraceCode())
            + ($gender->isFemale()
                ? $femaleModifiersTable->getIntelligence($this->getRaceCode())
                : 0
            );
    }

    /**
     * @param Gender $gender
     * @param RacesTable $racesTable
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getCharisma(Gender $gender, RacesTable $racesTable, FemaleModifiersTable $femaleModifiersTable)
    {
        return
            $racesTable->getCharisma($this->getRaceCode(), $this->getSubraceCode())
            + ($gender->isFemale()
                ? $femaleModifiersTable->getCharisma($this->getRaceCode())
                : 0
            );
    }

    /**
     * @param Gender $gender
     * @param RacesTable $racesTable
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getResistance(Gender $gender, RacesTable $racesTable, FemaleModifiersTable $femaleModifiersTable)
    {
        return
            $racesTable->getAgility($this->getRaceCode(), $this->getSubraceCode())
            + ($gender->isFemale()
                ? $femaleModifiersTable->getAgility($this->getRaceCode())
                : 0
            );
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return int
     */
    public function getSenses(RacesTable $racesTable)
    {
        return $racesTable->getSenses($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return int
     */
    public function getToughness(RacesTable $racesTable)
    {
        return $racesTable->getToughness($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return int
     */
    public function getSize(RacesTable $racesTable)
    {
        return $racesTable->getSize($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return int
     */
    public function getWeightInKg(RacesTable $racesTable)
    {
        return $racesTable->getWeightInKg($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return bool
     */
    public function hasInfravision(RacesTable $racesTable)
    {
        return $racesTable->hasInfravision($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return bool
     */
    public function hasNativeRegeneration(RacesTable $racesTable)
    {
        return $racesTable->hasNativeRegeneration($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return bool
     */
    public function requiresDungeonMasterAgreement(RacesTable $racesTable)
    {
        return $racesTable->requiresDmAgreement($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return false|string
     */
    public function getRemarkableSense(RacesTable $racesTable)
    {
        return $racesTable->getRemarkableSense($this->getRaceCode(), $this->getSubraceCode());
    }

}
