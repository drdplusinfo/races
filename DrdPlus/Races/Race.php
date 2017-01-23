<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\ScalarEnum;
use DrdPlus\Codes\GenderCode;
use DrdPlus\Codes\Properties\PropertyCode;
use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Tables\Measurements\Distance\Distance;
use DrdPlus\Tables\Measurements\Weight\Weight;
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
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getStrength(GenderCode $genderCode, Tables $tables)
    {
        if ($genderCode->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleStrength($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleStrength(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getAgility(GenderCode $genderCode, Tables $tables)
    {
        if ($genderCode->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleAgility($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleAgility(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getKnack(GenderCode $genderCode, Tables $tables)
    {
        if ($genderCode->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleKnack($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleKnack(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getWill(GenderCode $genderCode, Tables $tables)
    {
        if ($genderCode->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleWill($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleWill(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getIntelligence(GenderCode $genderCode, Tables $tables)
    {
        if ($genderCode->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleIntelligence($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleIntelligence(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getCharisma(GenderCode $genderCode, Tables $tables)
    {
        if ($genderCode->isMale()) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $tables->getRacesTable()->getMaleCharisma($this->getRaceCode(), $this->getSubraceCode());
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getFemaleCharisma(
            $this->getRaceCode(), $this->getSubraceCode(), $tables->getFemaleModifiersTable()
        );
    }

    /**
     * @param Tables $tables
     * @return int
     */
    public function getSenses(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getSenses($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param Tables $tables
     * @return int
     */
    public function getToughness(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getToughness($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getSize(GenderCode $genderCode, Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getSize(
            $this->getRaceCode(),
            $this->getSubraceCode(),
            $genderCode,
            $tables->getFemaleModifiersTable()
        );
    }

    /**
     * Bonus of body weight
     *
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int
     */
    public function getWeight(GenderCode $genderCode, Tables $tables)
    {
        $weightInKg = $this->getWeightInKg($genderCode, $tables);

        return (new Weight($weightInKg, Weight::KG, $tables->getWeightTable()))->getValue();
    }

    /**
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return float
     */
    public function getWeightInKg(GenderCode $genderCode, Tables $tables)
    {
        if ($genderCode->isMale()) {
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
     * @param Tables $tables
     * @return int
     */
    public function getHeightInCm(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getHeightInCm($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * Gives race height as bonus of distance (height in cm).
     * Useful for speed and fight modifiers.
     *
     * @param Tables $tables
     * @return int
     */
    public function getHeight(Tables $tables)
    {
        $heightInMeters = $this->getHeightInCm($tables) / 100;
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        $distance = new Distance($heightInMeters, Distance::M, $tables->getDistanceTable());

        return $distance->getBonus()->getValue();
    }

    /**
     * @param Tables $tables
     * @return bool
     */
    public function hasInfravision(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->hasInfravision($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param Tables $tables
     * @return bool
     */
    public function hasNativeRegeneration(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->hasNativeRegeneration($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param Tables $tables
     * @return bool
     */
    public function requiresDmAgreement(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->requiresDmAgreement($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param Tables $tables
     * @return string
     */
    public function getRemarkableSense(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getRemarkableSense($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * Gives usual age of a race on his first great adventure - like 15 years for common human or 25 for hobbit.
     *
     * @param Tables $tables
     * @return int
     */
    public function getAge(Tables $tables)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $tables->getRacesTable()->getAge($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param PropertyCode $propertyCode
     * @param GenderCode $genderCode
     * @param Tables $tables
     * @return int|float|bool|string
     * @throws \DrdPlus\Races\Exceptions\UnknownPropertyCode
     */
    public function getProperty(PropertyCode $propertyCode, GenderCode $genderCode, Tables $tables)
    {
        switch ($propertyCode->getValue()) {
            case PropertyCode::STRENGTH :
                return $this->getStrength($genderCode, $tables);
            case PropertyCode::AGILITY :
                return $this->getAgility($genderCode, $tables);
            case PropertyCode::KNACK :
                return $this->getKnack($genderCode, $tables);
            case PropertyCode::WILL :
                return $this->getWill($genderCode, $tables);
            case PropertyCode::INTELLIGENCE :
                return $this->getIntelligence($genderCode, $tables);
            case PropertyCode::CHARISMA :
                return $this->getCharisma($genderCode, $tables);
            case PropertyCode::SENSES :
                return $this->getSenses($tables);
            case PropertyCode::TOUGHNESS :
                return $this->getToughness($tables);
            case PropertyCode::SIZE :
                return $this->getSize($genderCode, $tables);
            case PropertyCode::WEIGHT :
                return $this->getWeight($genderCode, $tables);
            case PropertyCode::WEIGHT_IN_KG :
                return $this->getWeightInKg($genderCode, $tables);
            case PropertyCode::HEIGHT_IN_CM :
                return $this->getHeightInCm($tables);
            case PropertyCode::HEIGHT :
                return $this->getHeight($tables);
            case PropertyCode::INFRAVISION :
                return $this->hasInfravision($tables);
            case PropertyCode::NATIVE_REGENERATION :
                return $this->hasNativeRegeneration($tables);
            case PropertyCode::REQUIRES_DM_AGREEMENT :
                return $this->requiresDmAgreement($tables);
            case PropertyCode::REMARKABLE_SENSE :
                return $this->getRemarkableSense($tables);
            case PropertyCode::AGE :
                return $this->getAge($tables);
            default :
                throw new Exceptions\UnknownPropertyCode(
                    'Unknown property ' . ValueDescriber::describe($propertyCode)
                );
        }
    }
}