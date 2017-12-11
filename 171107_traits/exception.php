<?php
class PException extends Exception{}

class ExceptionTest{
    public function ThrowExceoption(){
        try{
            throw new PException();
        }catch (PException $e){
            echo "PException <br>";
            throw $e;
        }catch (Exception $e){
            echo "Exception <br>";
        }finally{
            echo "Finally <br>";
        }
    }
}

try{
    $obj = new ExceptionTest();
    $obj->ThrowExceoption();
} catch(Exception $e){
    echo "wow";
}