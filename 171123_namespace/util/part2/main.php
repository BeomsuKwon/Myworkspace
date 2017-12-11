<?php
require_once("../part1/test1.php");
require_once("../part1/test2.php");

use util\test1\test1 as t1;
use util\test2\test2 as t2;

t1::prt();
t2::prt();

class test2 {
    static function prt(){
        echo __CLASS__."<br>";
    }
}

test2::prt();