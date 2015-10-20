<?php
namespace DrdPlus\Tests\Races;

use DrdPlus\Races\Race;
use Granam\Exceptions\Tests\Tools\AbstractTestOfExceptionsHierarchy;

class ExceptionsHierarchyTest extends AbstractTestOfExceptionsHierarchy
{
    protected function getTestedNamespace()
    {
        $reflection = new \ReflectionClass(Race::class);

        return $reflection->getNamespaceName();
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

}
