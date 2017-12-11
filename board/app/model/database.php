<?php
class DB {
    const host = 'localhost';
    const user = 'root';
    const password = 'autoset';
    const database = 'MidTermExam';

    protected $conn = null;
    public function __construct(){
        $this->conn = new mysqli(self::host,
            self::user,
            self::password,
            self::database);
    }
}

class Select extends DB{
    public function one($userId){
        return $this->conn->query(
            "SELECT * FROM userinfo WHERE userid = '$userId'"
        );
    }
    public function all($pageIndex, $perPage){
        return $this->conn->query(
            "SELECT * FROM userinfo LIMIT ".$pageIndex * $perPage.", $perPage"
        );
    }
    public function getNumOfAll(){
        return $this->conn->query(
            "SELECT count(*) as NumOfAll FROM userinfo"
        );
    }
}

class Insert extends DB{
    public $result = false;
    public function __construct($queryArgs){
        parent::__construct();
        $this->result = $this->conn->query(
        "INSERT INTO userinfo ( 
                userid,
                name,
                password,
                classification,
                gender,
                phone,
                email) 
        VALUES ('{$queryArgs['userid']}',
                '{$queryArgs['username']}',
                '{$queryArgs['userpassword']}',
                '{$queryArgs['classification']}',
                '{$queryArgs['gender']}',
                '{$queryArgs['phone']}',
                '{$queryArgs['email']}')");
    }
}

class Delete extends DB{
    public function user($userid, $userpw){
        return $this->conn->query(
        "DELETE FROM userinfo
        WHERE userid = '{$userid}' AND password = '{$userpw}'"
        );
    }
}

class Update extends DB{
    public function run($queryArgs){
        foreach($queryArgs as $key=>$val){
            if($val == null) exit;
        }
        $this->conn->query(
        "UPDATE userinfo SET 
        userid =            '{$queryArgs['userid']}',
        classification =    '{$queryArgs['classification']}',
        name =              '{$queryArgs['username']}',
        gender =            '{$queryArgs['gender']}',
        password =          '{$queryArgs['userpassword']}',
        phone =             '{$queryArgs['phone']}',
        email =             '{$queryArgs['email']}'
        WHERE userid = '{$queryArgs['searchid']}'
        ");
    }
}