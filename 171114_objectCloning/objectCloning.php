<?php
class A {
    public $variable;

    function __construct($argValue){
        $this->variable = $argValue;
    }
}

class B {

}
class C {

}
$obj1 = new A(new B());
$obj2 = new A(new C());
$obj3 = new A(new B());
$obj4 = $obj1;

if($obj1 == $obj3){
    echo 1234;
}else {
    echo 2345;
}
