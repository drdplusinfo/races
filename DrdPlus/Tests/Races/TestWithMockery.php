<?php
namespace DrdPlus\Tests\Races;

class TestWithMockery extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        \Mockery::close();
    }
}
