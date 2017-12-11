<?php
class test implements Iterator {
    public $mValue0 = 19;
    public $mValue1 = array(5, 4, 3, 2, 1);
    public $mValue2 = array(6, 7, 8, 4, 5, 1, 2, 3, 4);
    public $mValue3 = array(10, 11, 12, 13);
    public $mValue4 = 20;
    public $hello   = "1234";
    public $hi      = 1.1234555;

    private $result;

    public function rewind(){
        # 객체의 모든 인스턴스 변수를 담을 배열
        $temp = get_object_vars($this);
        # 배열을 관리하기 위한 임시 변수
        $tempArr;
        foreach($temp as $key => $value){
            # 객체의 변수가 배열이 아닐때
            if(!is_array($value) && !is_null($value)){
                # 결과값에 옮김
                $this->result[$key] = $value;
            # 객체의 변수가 배열일 때
            } else if(is_array($value)){
                # 임시 배열에 옮겨 담음
                $tempArr[$key] = $value;
            }
        }
    
        do{
            $flag = false;
            foreach($tempArr as $key => $value){
                # 각 배열의 첫번째 값을 순차적으로 추출
                $val = array_shift($tempArr[$key]);
                # tempArr의 배열중에 하나라도 null이 아닐 때 while문을 계속 수행함
                if($val !== null){
                    # 추출한 값을 결과값에 옮겨 담음
                    $this->result[] = $val;
                    $flag = true;
                }
            }
        }while($flag);
    }
        
    public function valid(){
        if(valid($this->result)){
            return true;
        }
        return false;
    }

    public function current(){
        return current($this->result);
    }

    public function key(){
        return key($this->result);
    }

    public function next(){
        next($this->result);
    }
}

$obj = new test();
foreach($obj as $key => $value){
    echo "$key : $value<br>";
}