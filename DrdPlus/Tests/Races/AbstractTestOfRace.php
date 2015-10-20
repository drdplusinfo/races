<?php
namespace DrdPlus\Tests\Races;

use DrdPlus\Races\Dwarfs\CommonDwarf;
use DrdPlus\Races\Race;

abstract class AbstractTestOfRace extends TestWithMockery
{
    /**
     * @test
     */
    public function I_can_get_subrace()
    {
        $subraceClass = $this->getSubraceClass();
        $subrace = $subraceClass::getIt();
        $this->assertInstanceOf($subraceClass, $subrace);
        $this->assertSame($this->getRaceCode(), $subrace->getRaceCode());
        $this->assertSame($this->getSubraceCode(), $subrace->getSubraceCode());
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
}
