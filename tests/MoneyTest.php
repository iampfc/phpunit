<?php
/*
|------------------------------------------------
|
|      Filename: tests/MoneyTest.php
|
|        Author: Wing - 183862684@qq.com
|   Description: ---
|        Create: 2017-07-12 08:46:30
|
|------------------------------------------------
*/

class MoneyTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeNegated()
    {
        $a = new Money(1);

        $b = $a->negate();

        $this->assertEquals(-1, $b->getAmount());
    }
}
