<?php
trait IGoMoYa1{
    private $test = "test i-variable";

    function __construct(){
        echo "IGoMoYa's constructor is invoked!! <br />";
    }
    function __destruct(){
        echo "IGoMoYa's destruct is invoked!! <br />";
    }
    function test() {
        echo "IGoMoYa's test() is invoked!! <br />";
    }
}
trait IGoMoYa2{
    private $test = "test i-variable";

    function __construct(){
        echo "IGoMoYa's constructor is invoked!! <br />";
    }
    function __destruct(){
        echo "IGoMoYa's destruct is invoked!! <br />";
    }
    function test() {
        echo "IGoMoYa's test() is invoked!! <br />";
    }
}

class Test{
    private $test = 1;
    function __construct(){
        echo "qwerwrqwer <br>";
    }
}
class Main extends Test{
    private $test = 2;
    use IGoMoYa1;
    function __construct(){
        echo $this->test;
        echo "qwerwrqwer <br>";
    }
}

echo "It's Show Time!!! <br>";
$obj = new Main();
$obj->test();