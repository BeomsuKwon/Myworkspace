<?php
require("../models/model_chatting_system.php");
$conn = new ChattingSystemModel();

$user_no = $_SESSION['user_no'];
$room_name = $_POST['room_name'];
$room_no = $conn->open_room($user_no, $room_name);
?>
<script>
    location.href="./joinRoom.html";
</script>