<?php
class Test{
    private $i_v_1 = "variable 1";
    private $i_v_2 = "";
    public $i_v_3 = 1234;
    const constraint = 1234;
    function printAllVariable(){
        echo $this->i_v_1.":".$this->i_v_2."<br>";
    }

    function setVariable2($argValue){
        $this->i_v_2 = $argValue;
    }
}

$obj = new Test();
$obj->setVariable2("OpaOpa~~~");
echo serialize($obj);

$byteStream = serialize($obj);
$unserializedObj = unserialize('O:4:"Test":3:{s:11:"Testi_v_1";s:10:"variable 1";s:11:"Testi_v_2";s:9:"OpaOpa~~~";s:5:"i_v_3";i:1234;}');

echo "<br><br>----After unserializing----<br><br>";
var_dump($unserializedObj);