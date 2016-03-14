<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\ScalarEnum;
use Drd\Genders\Gender;
use DrdPlus\Codes\PropertyCodes;
use DrdPlus\Races\Humans\Highlander;
use DrdPlus\Races\Orcs\CommonOrc;
use DrdPlus\Races\Orcs\Orc;
use DrdPlus\Tables\Races\RacesTable;
use DrdPlus\Tables\Tables;
use Granam\Tools\ValueDescriber;

abstract class Race extends ScalarEnum
{
    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return Race
     */
    public static function getItByCodes($raceCode, $subraceCode)
    {
        $subraceClass = static::getSubraceClassByCodes($raceCode, $subraceCode);

        return $subraceClass::getEnum(self::createRaceAndSubraceCode($raceCode, $subraceCode));
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return string|Race
     */
    protected static function getSubraceClassByCodes($raceCode, $subraceCode)
    {
        $subraceNamespace = __NAMESPACE__ . '\\' . ucfirst($raceCode) . 's' . '\\';
        if ($raceCode !== Orc::ORC || $subraceCode === CommonOrc::COMMON) {
            if ($subraceCode !== Highlander::HIGHLANDER) {
                return $subraceNamespace . ucfirst($subraceCode) . ucfirst($raceCode);
            } else {
                return $subraceNamespace . ucfirst($subraceCode);
            }
        } else {
            return $subraceNamespace . ucfirst($subraceCode);
        }
    }

    public function __construct($value)
    {
        parent::__construct($value);
        $this->checkRaceEnumValue($this->getValue());
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
     * @param Tables $tables
     *
     * @return int
     */
    public function getStrength(Gender $gender, Tables $tables)
    {
        if ($gender->isMale()) {
            return $tables->getRacesTable()->getMaleStrength($this->getRaceCode(), $this->getSubraceCode());
        }

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
            return $tables->getRacesTable()->getMaleAgility($this->getRaceCode(), $this->getSubraceCode());
        }

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
            return $tables->getRacesTable()->getMaleKnack($this->getRaceCode(), $this->getSubraceCode());
        }

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
            return $tables->getRacesTable()->getMaleWill($this->getRaceCode(), $this->getSubraceCode());
        }

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
            return $tables->getRacesTable()->getMaleIntelligence($this->getRaceCode(), $this->getSubraceCode());
        }

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
            return $tables->getRacesTable()->getMaleCharisma($this->getRaceCode(), $this->getSubraceCode());
        }

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
            return $tables->getRacesTable()->getMaleWeightInKg($this->getRaceCode(), $this->getSubraceCode());
        }

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

    /**
     * @param $propertyCode
     * @param Gender $gender
     * @param Tables $tables
     * @return int|bool|string
     */
    public function getProperty($propertyCode, Gender $gender, Tables $tables)
    {
        switch ($propertyCode) {
            case PropertyCodes::STRENGTH :
                return $this->getStrength($gender, $tables);
            case PropertyCodes::AGILITY :
                return $this->getAgility($gender, $tables);
            case PropertyCodes::KNACK :
                return $this->getKnack($gender, $tables);
            case PropertyCodes::WILL :
                return $this->getWill($gender, $tables);
            case PropertyCodes::INTELLIGENCE :
                return $this->getIntelligence($gender, $tables);
            case PropertyCodes::CHARISMA :
                return $this->getCharisma($gender, $tables);
            case PropertyCodes::SENSES :
                return $this->getSenses($tables->getRacesTable());
            case PropertyCodes::TOUGHNESS :
                return $this->getToughness($tables->getRacesTable());
            case PropertyCodes::SIZE :
                return $this->getSize($gender, $tables);
            case PropertyCodes::WEIGHT_IN_KG :
                return $this->getWeightInKg($gender, $tables);
            case PropertyCodes::HEIGHT_IN_CM :
                return $this->getHeightInCm($tables->getRacesTable());
            case PropertyCodes::INFRAVISION :
                return $this->hasInfravision($tables->getRacesTable());
            case PropertyCodes::NATIVE_REGENERATION :
                return $this->hasNativeRegeneration($tables->getRacesTable());
            case PropertyCodes::REQUIRES_DM_AGREEMENT :
                return $this->requiresDmAgreement($tables->getRacesTable());
            case PropertyCodes::REMARKABLE_SENSE :
                return $this->getRemarkableSense($tables->getRacesTable());
            default :
                throw new Exceptions\UnknownPropertyCode(
                    "Unknown code of property " . ValueDescriber::describe($propertyCode)
                );
        }
    }

    public function getBaseProperty($basePropertyCode, Gender $gender, Tables $tables)
    {
        switch ($basePropertyCode) {
            case PropertyCodes::STRENGTH :
            case PropertyCodes::AGILITY :
            case PropertyCodes::KNACK :
            case PropertyCodes::WILL :
            case PropertyCodes::INTELLIGENCE :
            case PropertyCodes::CHARISMA :
                return $this->getProperty($basePropertyCode, $gender, $tables);
            default :
                throw new Exceptions\UnknownBasePropertyCode(
                    "Unknown code of base property " . ValueDescriber::describe($basePropertyCode)
                );
        }
    }
}
