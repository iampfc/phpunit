<?php

function __autoload($class){
    include $class.'.php';
}

spl_autoload_register('__autoload');
