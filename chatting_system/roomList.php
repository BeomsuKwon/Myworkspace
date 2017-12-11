<?php
require("../models/model_chatting_system.php");

$conn = new ChattingSystemModel();
if(isset($_SESSION['room_no'])){
    $user_no = $_SESSION['user_no'];
    $room_no = $_SESSION['room_no'];
    $conn->leave_room($user_no, $room_no);
}
$room_list = $conn->get_room_list();
?>