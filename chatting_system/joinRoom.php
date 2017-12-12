<?php
require("../models/model_chatting_system.php");
$conn = new ChattingSystemModel();

$user_no = $_SESSION['user_no'];
@$_SESSION['room_no'] = $_GET['room_no'];
$room_no = $_SESSION['room_no'];
$conn->join_room($user_no, $room_no);
?>
<script>location.href='./joinRoom.html';</script>