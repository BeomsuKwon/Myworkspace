<?php
class UserController{
    // 페이지당 표시 할 게시글 수
    const PERPAGE = 10;
    public function index(){
        require 'app/views/main.html';
    }
    public function register(){
        require 'app/views/register.html';
    }
    public function modify(){
        require 'app/views/modify.html';
    }
    public function delete(){
        require 'app/views/delete.html';
    }
    public function userList(){
        require 'app/model/database.php';
        $result = $this->listup();
        $select = new Select();
        $max = $select->getNumOfAll()->fetch_assoc();
        $max = $max['NumOfAll'];
        require 'app/views/listup.html';
    }

    public function registrationProcessing(){
        $nullFlag = false;
        foreach($_POST as $key=>$value){
            if($value == "") $nullFlag = true;
        }
        if(!$nullFlag){
            require 'app/model/database.php';
            $insert = new Insert($_POST);
            $_POST['message'] = "유저 등록 성공";
        } else {
            $_POST['message'] = "다음의 항목들을 입력해주세요";
        }
        exit(json_encode($_POST));
    }

    public function SearchUser(){
        require 'app/model/database.php';
        $select = new Select();
        $result = $select->one($_POST['userid']);
        $row = $result->fetch_assoc();
        exit(json_encode($row));
    }

    public function modifyUser(){
        $userData = $_POST;
        require 'app/model/database.php';
        $update = new Update();
        exit(json_encode($update->run($userData)));
    }

    public function deleteUser(){
        require 'app/model/database.php';
        $select = new Select();
        $result = $select->one($_POST['userid']);
        $user = $result->fetch_assoc();
        if(is_null($user)) exit("등록되지 않은 ID입니다.");
        if($_POST['password'] != $user['password']) exit("암호가 일치하지 않습니다.");
        $delete = new Delete();
        $result = $delete->user($_POST['userid'], $_POST['password']);
        exit(json_encode($result));
    }

    public function listup(){
        $pageIndex = isset($_GET['pageIndex']) ? $_GET['pageIndex'] : 0;
        $_GET['pageIndex'] = $pageIndex;
        $select = new Select();
        return $select->all($pageIndex, self::PERPAGE);
    }
}