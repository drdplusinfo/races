<?php
namespace DrdPlus\Races;

use Doctrineum\Scalar\Enum;

abstract class Race extends Enum
{

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return static
     */
    protected static function getIt($raceCode, $subraceCode)
    {
        return static::getEnum("$raceCode-$subraceCode");
    }

    /**
     * All races can be annotated just as "race" type.
     * The specific race will be build here, distinguished by the race and subrace code.
     * Warning - each specific race has to be registered as a Doctrine type,
     * @see Race::registerSelf() and inherited
     *
     * @param string $raceAndSubraceCode
     *
     * @return Race
     */
    protected static function createByValue($raceAndSubraceCode)
    {
        $raceWithSubrace = parent::createByValue($raceAndSubraceCode);
        /** @var $raceWithSubrace Race */
        if (get_class($raceWithSubrace) === __CLASS__) {
            // create() method, or get() respectively, has to be called on a specific race, not on this abstract one
            throw new Exceptions\GenericRaceCanNotBeCreated(
                'Given race-subrace code ' . var_export($raceAndSubraceCode, true) .
                ' should never results into generic ' . self::class
            );
        }

        return $raceWithSubrace;
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
