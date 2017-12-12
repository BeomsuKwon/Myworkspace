<?php
require("../models/model_chatting_system.php");

$conn = new ChattingSystemModel();
$pageIndex = isset($_GET['pageIndex']) ? $_GET['pageIndex'] : 0;
$perPage = 5;
$block = intVal($pageIndex / $perPage) * $perPage;

if(isset($_SESSION['room_no'])){
    $user_no = $_SESSION['user_no'];
    $room_no = $_SESSION['room_no'];
    $conn->leave_room($user_no, $room_no);
}

$room_list = $conn->get_room_list($pageIndex, $perPage);
$max = $conn->get_room_num($perPage);
$max_block = intVal($max / $perPage);
?>