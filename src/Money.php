<?php
/*
|------------------------------------------------
|
|      Filename: src/Money.php
|
|        Author: Wing - 183862684@qq.com
|   Description: ---
|        Create: 2017-07-12 08:46:06
|
|------------------------------------------------
*/

class Money
{
    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function negate()
    {
        return new Money(-1*$this->amount);
    }
}

