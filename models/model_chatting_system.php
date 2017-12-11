<?php
require(__DIR__."/main.php");

class ChattingSystemModel{
    const DATABASE  = "chatting_system";
    private $connection = null;

    function __construct(){
        session_start();
        $this->connection = Model::get_connection(self::DATABASE);
    }

    function __destruct(){
        if(!isset($_SESSION['user_no'])){
            echo "<script>location.href='./login.html';</script>";
        }
    }

    function registeration($user_id, $user_password){
        $user_id = filter_var($user_id, FILTER_SANITIZE_STRIPPED);
        $user_password = filter_var($user_password, FILTER_SANITIZE_STRIPPED);

        @$res = $this->connection
        ->query("INSERT INTO users(id, password)
                 SELECT '$user_id', SHA2('$user_password', 224)
                 FROM DUAL
                 WHERE NOT EXISTS
                    (SELECT *
                    FROM users
                    WHERE id = '$user_id')");
    }

    function login($user_id, $user_password){
        $user_id = filter_var($user_id, FILTER_SANITIZE_STRIPPED);
        $user_password = filter_var($user_password, FILTER_SANITIZE_STRIPPED);

        $this->registeration($user_id, $user_password);

        @$res = $this->connection
        ->query("SELECT no FROM users WHERE id = '$user_id' AND password = SHA2('$user_password', 224)")
        ->fetch_array(MYSQLI_ASSOC)['no'];

        if(!$res){
            echo "<script>alert('Failed to Login');</script>";
            return false;
        } else {
            $_SESSION['user_no'] = $res;
            return true;
        }
    }

    function get_room_list($pageIndex = 0, $perPage = 0){
        unset($_SESSION['room_no']);
        $res = $this->connection
        ->query("SELECT r.no '방 번호', r.name '방 제목', u.id 방장, COUNT(*) num
                 FROM users u, rooms r, user_admissions uad 
                 WHERE u.no = uad.user_no 
                 AND r.no = uad.room_no
                 GROUP BY '방 번호'")
        ->fetch_all(MYSQLI_ASSOC);
        if($res){
            return $res;
        }
    }

    function open_room($user_no, $room_name){
        $room_name = filter_var($room_name, FILTER_SANITIZE_STRIPPED);
        $res = $this->connection
        ->query("INSERT INTO rooms(name) VALUES('$room_name')");
        
        $room_no = $this->connection
        ->query("SELECT no FROM rooms WHERE name = '$room_name'")
        ->fetch_array(MYSQLI_ASSOC)['no'];

        $_SESSION['room_no'] = $room_no;

        $this->join_room($user_no, $room_no);

        return $room_no;
    }

    function join_room($user_no, $room_no){
        $res = $this->connection
        ->query("INSERT INTO user_admissions(user_no, room_no)
                 SELECT $user_no, $room_no
                 FROM DUAL
                 WHERE NOT EXISTS
                    (SELECT * 
                    FROM user_admissions 
                    WHERE user_no = $user_no 
                    AND 
                    room_no = $room_no)
                ");
        $res = $this->connection
        ->query("INSERT INTO chat_logs(user_no, room_no, content) 
                 VALUES($user_no, $room_no, 
                 (SELECT CONCAT(id, '님이 입장하셨습니다.') FROM users WHERE no = $user_no))");
    }

    function leave_room($user_no, $room_no){
        $res = $this->connection
        ->query("DELETE FROM user_admissions 
                 WHERE user_no = $user_no AND room_no = $room_no");

        $res = $this->connection
        ->query("INSERT INTO chat_logs(user_no, room_no, content) 
        VALUES($user_no, $room_no, 
        (SELECT CONCAT(id, '님이 퇴장하셨습니다.') FROM users WHERE no = $user_no))");

        $res = $this->connection
        ->query("DELETE FROM rooms
                 WHERE NOT EXISTS 
                    (SELECT 'rooms' 
                     from user_admissions 
                     where rooms.no = user_admissions.room_no)");
    }

    function input_chat_message($user_no, $room_no, $content){
        $content = filter_var($content, FILTER_SANITIZE_STRIPPED);
        $res = $this->connection
        ->query("INSERT INTO chat_logs(user_no, room_no, content) VALUES($user_no, $room_no, '$content')");
    }

    function get_chat_list($user_no, $room_no){
        $res = $this->connection
        ->query("SELECT u.id as user_id, c.date date, c.content content 
                 FROM users u, rooms r, chat_logs c
                 WHERE u.no = c.user_no
                 AND r.no = c.room_no
                 AND r.no = $room_no 
                 AND (SELECT date 
                      FROM user_admissions 
                      WHERE user_no = $user_no
                      AND room_no = $room_no) <= c.date 
                 GROUP BY date
                 ORDER BY date ASC")->fetch_all(MYSQLI_ASSOC);
        return $res;
    }
}
?>