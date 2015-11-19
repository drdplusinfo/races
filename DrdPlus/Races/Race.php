<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\Enum;
use Drd\Genders\Gender;
use DrdPlus\Tables\Measurements\Weight\WeightTable;
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
     * @param RacesTable $racesTable
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getStrength(RacesTable $racesTable, Gender $gender, FemaleModifiersTable $femaleModifiersTable)
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleStrength($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleStrength($this->getRaceCode(), $this->getSubraceCode(), $femaleModifiersTable);
    }

    /**
     * @param RacesTable $racesTable
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getAgility(RacesTable $racesTable, Gender $gender, FemaleModifiersTable $femaleModifiersTable)
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleAgility($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleAgility($this->getRaceCode(), $this->getSubraceCode(), $femaleModifiersTable);
    }

    /**
     * @param RacesTable $racesTable
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getKnack(RacesTable $racesTable, Gender $gender, FemaleModifiersTable $femaleModifiersTable)
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleKnack($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleKnack($this->getRaceCode(), $this->getSubraceCode(), $femaleModifiersTable);
    }

    /**
     * @param RacesTable $racesTable
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getWill(RacesTable $racesTable, Gender $gender, FemaleModifiersTable $femaleModifiersTable)
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleWill($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleWill($this->getRaceCode(), $this->getSubraceCode(), $femaleModifiersTable);
    }

    /**
     * @param RacesTable $racesTable
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getIntelligence(RacesTable $racesTable, Gender $gender, FemaleModifiersTable $femaleModifiersTable)
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleIntelligence($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleIntelligence($this->getRaceCode(), $this->getSubraceCode(), $femaleModifiersTable);
    }

    /**
     * @param RacesTable $racesTable
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     *
     * @return int
     */
    public function getCharisma(RacesTable $racesTable, Gender $gender, FemaleModifiersTable $femaleModifiersTable)
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleCharisma($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleCharisma($this->getRaceCode(), $this->getSubraceCode(), $femaleModifiersTable);
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
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     * @return int
     */
    public function getSize(RacesTable $racesTable, Gender $gender, FemaleModifiersTable $femaleModifiersTable)
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleSize($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleSize($this->getRaceCode(), $this->getSubraceCode(), $femaleModifiersTable);
    }

    /**
     * @param RacesTable $racesTable
     * @param Gender $gender
     * @param FemaleModifiersTable $femaleModifiersTable
     * @param WeightTable $weightTable
     * @return float
     */
    public function getWeightInKg(
        RacesTable $racesTable,
        Gender $gender,
        FemaleModifiersTable $femaleModifiersTable,
        WeightTable $weightTable
    )
    {
        if ($gender->isMale()) {
            return $racesTable->getMaleWeightInKg($this->getRaceCode(), $this->getSubraceCode());
        }

        return $racesTable->getFemaleWeightInKg(
            $this->getRaceCode(),
            $this->getSubraceCode(),
            $femaleModifiersTable,
            $weightTable
        );
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return int
     */
    public function getHeightInCm(RacesTable $racesTable)
    {
        return $racesTable->getHeightInCm($this->getRaceCode(), $this->getSubraceCode());
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
    public function requiresDmAgreement(RacesTable $racesTable)
    {
        return $racesTable->requiresDmAgreement($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return string
     * @return string
     */
    public function getRemarkableSense(RacesTable $racesTable)
    {
        return $racesTable->getRemarkableSense($this->getRaceCode(), $this->getSubraceCode());
    }

}
