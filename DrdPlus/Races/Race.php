<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\ScalarEnum;
use Drd\Genders\Gender;
use DrdPlus\Codes\PropertyCode;
use DrdPlus\Tables\Races\RacesTable;
use DrdPlus\Tables\Tables;
use Granam\Scalar\Tools\ToString;
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
     * @throws \DrdPlus\Races\Exceptions\InvalidRaceCode
     */
    public function __construct($value)
    {
        parent::__construct($value);
        $this->checkRaceEnumValue($this->getValue());
    }

    /**
     * @param string $value
     * @throws Exceptions\UnknownRaceCode
     * @throws \DrdPlus\Races\Exceptions\InvalidRaceCode
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
     * @param string $raceCode
     * @param string $subraceCode
     * @return static
     * @throws \DrdPlus\Races\Exceptions\InvalidRaceCode
     */
    protected static function getItByRaceAndSubrace($raceCode, $subraceCode)
    {
        return self::getEnum(self::createRaceAndSubraceCode($raceCode, $subraceCode));
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return string
     * @throws \DrdPlus\Races\Exceptions\InvalidRaceCode
     */
    public static function createRaceAndSubraceCode($raceCode, $subraceCode)
    {
        try {
            $raceCode = ToString::toString($raceCode);
            $subraceCode = ToString::toString($subraceCode);
        } catch (\Granam\Scalar\Tools\Exceptions\WrongParameterType $exception) {
            throw new Exceptions\InvalidRaceCode(
                'Both race codes have to be represented by string, got '
                . ValueDescriber::describe($raceCode) . ', ' . ValueDescriber::describe($subraceCode),
                $exception->getCode(),
                $exception
            );
        }

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
     * @param Tables $tables
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
        return $tables->getRacesTable()->getSize(
            $this->getRaceCode(),
            $this->getSubraceCode(),
            $gender->getValue(),
            $tables->getFemaleModifiersTable()
        );
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
     *
     * @return int
     */
    public function getHeightInCm(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->getHeightInCm($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return bool
     */
    public function hasInfravision(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->hasInfravision($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return bool
     */
    public function hasNativeRegeneration(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->hasNativeRegeneration($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param RacesTable $racesTable
     *
     * @return bool
     */
    public function requiresDmAgreement(RacesTable $racesTable)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
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
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $racesTable->getRemarkableSense($this->getRaceCode(), $this->getSubraceCode());
    }

    /**
     * @param $propertyCode
     * @param Gender $gender
     * @param Tables $tables
     * @return int
     * @throws Exceptions\UnknownPropertyCode
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
            case PropertyCode::WEIGHT_IN_KG :
                return $this->getWeightInKg($gender, $tables);
            case PropertyCode::HEIGHT_IN_CM :
                return $this->getHeightInCm($tables->getRacesTable());
            case PropertyCode::INFRAVISION :
                return $this->hasInfravision($tables->getRacesTable());
            case PropertyCode::NATIVE_REGENERATION :
                return $this->hasNativeRegeneration($tables->getRacesTable());
            case PropertyCode::REQUIRES_DM_AGREEMENT :
                return $this->requiresDmAgreement($tables->getRacesTable());
            case PropertyCode::REMARKABLE_SENSE :
                return $this->getRemarkableSense($tables->getRacesTable());
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
     * @throws Exceptions\UnknownBasePropertyCode
     * @throws Exceptions\UnknownPropertyCode
     */
    public function getBaseProperty($basePropertyCode, Gender $gender, Tables $tables)
    {
        switch ($basePropertyCode) {
            case PropertyCode::STRENGTH :
            case PropertyCode::AGILITY :
            case PropertyCode::KNACK :
            case PropertyCode::WILL :
            case PropertyCode::INTELLIGENCE :
            case PropertyCode::CHARISMA :
                return $this->getProperty($basePropertyCode, $gender, $tables);
            default :
                throw new Exceptions\UnknownBasePropertyCode(
                    'Unknown code of base property ' . ValueDescriber::describe($basePropertyCode)
                );
        }
    }
}