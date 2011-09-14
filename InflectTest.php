<?php

namespace Inflect;

require_once __DIR__ . '/Inflect.php';

class InflectTest extends \PHPUnit_Framework_TestCase
{
    public function testWord()
    {
        $inflect = new Inflect('проверка');
        $result = $inflect->inflect();
        $this->assertEquals(array('проверка', 'проверки', 'проверке', 'проверку', 'проверкой', 'проверке'), $result);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testException()
    {
        $inflect = new Inflect('Unknown');
        $inflect->inflect();
    }
}
