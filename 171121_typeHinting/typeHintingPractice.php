<?php

class TypeHintingTest {
    function CykaClass (Cyka $c) {
        $c->prt();
    }
}

class Cyka {
    function prt() {
        echo "prt() in Cyka is invoked <Br>";
    }
}

$c = new Cyka();
$t = new TypeHintingTest();

$t->CykaClass($c);
$t->CykaClass(1818218);

interface testInt {
    public function prtInt();
}
class test implements testInt {
    public function prtInt() {
        echo "prtInt() in test in invoked<br>";
    }
}

class TypeHintingTest {
    function arrayTest (array $a) {
        foreach($array as $key => $value)
            echo "{$key} => {$value}";
    }

    function InterfaceTest (testInt $i) {
        $i->prtInt();
    }

    function callableTest (callable $c, $data) {
        call_user_func($c, $data);
    }
}

$t = new TypeHintingTest();

$t->arrayTest(1);
$t->arrayTest(1818218);
$t->arrayTest(1, 2);


?>