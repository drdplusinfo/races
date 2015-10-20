<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\Enum;
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

}
