<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\ScalarEnum;
use DrdPlus\Genders\Gender;
use DrdPlus\Codes\PropertyCode;
use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Tables\Measurements\Distance\Distance;
use DrdPlus\Tables\Measurements\Distance\DistanceTable;
use DrdPlus\Tables\Measurements\Weight\Weight;
use DrdPlus\Tables\Races\RacesTable;
use DrdPlus\Tables\Tables;
use Granam\String\StringInterface;
use Granam\Tools\ValueDescriber;

/**
 * @method static Race getEnum($value)
 */
abstract class Race extends ScalarEnum
{
    /**
     * @param string|StringInterface $value
     * @throws Exceptions\UnknownRaceCode
     * @throws \Doctrineum\Scalar\Exceptions\UnexpectedValueToEnum
     */
    protected function __construct($value)
    {
        parent::__construct($value);
        $this->checkRaceEnumValue($this->getValue());
    }

    /**
     * @param string $value
     * @throws Exceptions\UnknownRaceCode
     */
    private function checkRaceEnumValue($value)
    {
        if ($value !== self::createRaceAndSubraceCode($this->getRaceCode(), $this->getSubraceCode())) {
            throw new Exceptions\UnknownRaceCode(
                'Expected ' . self::createRaceAndSubraceCode($this->getRaceCode(), $this->getSubraceCode())
                . ' got ' . ValueDescriber::describe($value)
            );
        }
    }

    /**
     * @param RaceCode $raceCode
     * @param SubRaceCode $subraceCode
     * @return Race
     */
    protected static function getItByRaceAndSubrace(RaceCode $raceCode, SubRaceCode $subraceCode)
    {
        return self::getEnum(self::createRaceAndSubraceCode($raceCode, $subraceCode));
    }

    /**
     * @param RaceCode $raceCode
     * @param SubRaceCode $subraceCode
     * @return string
     */
    private static function createRaceAndSubraceCode(RaceCode $raceCode, SubRaceCode $subraceCode)
    {
        return "$raceCode-$subraceCode";
    }

    /**
     * @return RaceCode
     */
    abstract public function getRaceCode();

    /**
     * @return SubRaceCode
     */
    abstract public function getSubraceCode();

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getStrength(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleStrength($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleStrength(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getAgility(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleAgility($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleAgility(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getKnack(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleKnack($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleKnack(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getWill(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleWill($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleWill(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getIntelligence(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleIntelligence($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleIntelligence(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getCharisma(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleCharisma($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleCharisma(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param RacesTable $racesTable
     * @return int
     */
    public function getSenses(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->getSenses($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     * @return int
     */
    public function getToughness(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->getToughness($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getSize(Gender $gender, Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getSize(
            $this->getRaceCode(),
            $this->getSubraceCode(),
            $gender->getCode(),
            $tables->getFemaleModifiersTable()
        );
    }

    /**
     * Bonus of body weight
     *
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     */
    public function getWeight(Gender $gender, Tables $tables)
    {
        $weightInKg = $this->getWeightInKg($gender, $tables);

        return (new Weight($weightInKg, Weight::KG, $tables->getWeightTable()))->getValue();
    }

    /**
     * @param Gender $gender
     * @param Tables $tables
     * @return float
     */
    public function getWeightInKg(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleWeightInKg($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleWeightInKg(
            $this->getRaceCode(),
            $this->getSubraceCode(),
            $tables->getFemaleModifiersTable(),
            $tables->getWeightTable()
        );
    }

    /**
     * @param RacesTable $racesTable
     * @return int
     */
    public function getHeightInCm(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->getHeightInCm($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * Gives race height as bonus of distance (height in cm).
     * Useful for speed and fight modifiers.
     *
     * @param RacesTable $racesTable
     * @param DistanceTable $distanceTable
     * @return int
     */
    public function getHeight(RacesTable $racesTable, DistanceTable $distanceTable)
    {
        $heightInMeters = $this->getHeightInCm($racesTable) / 100;
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        $distance = new Distance($heightInMeters, Distance::M, $distanceTable);

        return $distance->getBonus()->getValue();
    }

    /**
     * @param RacesTable $racesTable
     * @return bool
     */
    public function hasInfravision(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->hasInfravision($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     * @return bool
     */
    public function hasNativeRegeneration(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->hasNativeRegeneration($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     * @return bool
     */
    public function requiresDmAgreement(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->requiresDmAgreement($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     * @return string
     */
    public function getRemarkableSense(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->getRemarkableSense($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * Gives usual age of a race on his first great adventure - like 15 years for common human or 25 for hobbit.
     *
     * @param RacesTable $racesTable
     * @return int
     */
    public function getAge(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->getAge($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param $propertyCode
     * @param Gender $gender
     * @param Tables $tables
     * @return int|float|bool|string
     * @throws \DrdPlus\Races\Exceptions\UnknownPropertyCode
     */
    public function getProperty($propertyCode, Gender $gender, Tables $tables)
    {
        switch ($propertyCode) {
            case PropertyCode::STRENGTH :
                return $this->getStrength($gender, $tables);
            case PropertyCode::AGILITY :
                return $this->getAgility($gender, $tables);
            case PropertyCode::KNACK :
                return $this->getKnack($gender, $tables);
            case PropertyCode::WILL :
                return $this->getWill($gender, $tables);
            case PropertyCode::INTELLIGENCE :
                return $this->getIntelligence($gender, $tables);
            case PropertyCode::CHARISMA :
                return $this->getCharisma($gender, $tables);
            case PropertyCode::SENSES :
                return $this->getSenses($tables->getRacesTable());
            case PropertyCode::TOUGHNESS :
                return $this->getToughness($tables->getRacesTable());
            case PropertyCode::SIZE :
                return $this->getSize($gender, $tables);
            case PropertyCode::WEIGHT :
                return $this->getWeight($gender, $tables);
            case PropertyCode::WEIGHT_IN_KG :
                return $this->getWeightInKg($gender, $tables);
            case PropertyCode::HEIGHT_IN_CM :
                return $this->getHeightInCm($tables->getRacesTable());
            case PropertyCode::HEIGHT :
                return $this->getHeight($tables->getRacesTable(), $tables->getDistanceTable());
            case PropertyCode::INFRAVISION :
                return $this->hasInfravision($tables->getRacesTable());
            case PropertyCode::NATIVE_REGENERATION :
                return $this->hasNativeRegeneration($tables->getRacesTable());
            case PropertyCode::REQUIRES_DM_AGREEMENT :
                return $this->requiresDmAgreement($tables->getRacesTable());
            case PropertyCode::REMARKABLE_SENSE :
                return $this->getRemarkableSense($tables->getRacesTable());
            case PropertyCode::AGE :
                return $this->getAge($tables->getRacesTable());
            default :
                throw new Exceptions\UnknownPropertyCode(
                    'Unknown code of property ' . ValueDescriber::describe($propertyCode)
                );
        }
    }

    /**
     * @param string $basePropertyCode
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     * @throws \DrdPlus\Races\Exceptions\UnknownBasePropertyCode
     * @throws \DrdPlus\Races\Exceptions\UnknownPropertyCode
     */
    public function getBaseProperty($basePropertyCode, Gender $gender, Tables $tables)
    {
        if (in_array($basePropertyCode, PropertyCode::getBasePropertyPossibleValues(), true)) {
            return $this->getProperty($basePropertyCode, $gender, $tables);
        }
        throw new Exceptions\UnknownBasePropertyCode(
            'Unknown base property ' . ValueDescriber::describe($basePropertyCode)
        );
    }
}