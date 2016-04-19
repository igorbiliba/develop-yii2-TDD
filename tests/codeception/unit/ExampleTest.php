<?php


class ExampleTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {
        expect('equael has el', 'equael')->contains('el');
        expect('equael not has qel', 'equael')->notContains('qel');
    }
}