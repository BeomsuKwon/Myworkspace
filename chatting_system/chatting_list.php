<?php
require("../models/model_chatting_system.php");
$conn = new ChattingSystemModel();

@$user_no = $_SESSION['user_no'];
@$room_no = $_SESSION['room_no'];
@$content = $_POST['content'];

if($user_no && $room_no && $content){
    $conn->input_chat_message($user_no, $room_no, $content);
}
if($user_no == null || $room_no == null){
    exit("비정상적인 접근 입니다.");
}
$chat_list = $conn->get_chat_list($user_no, $room_no);

foreach($chat_list as $col => $record){
    echo "{$record['user_id']}({$record['date']})<br />";
    echo "{$record['content']}<br />";
}
?>