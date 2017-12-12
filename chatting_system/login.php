<?php
require("../models/model_chatting_system.php");
$conn = new ChattingSystemModel();

if(isset($_SESSION['room_no'])){
    $user_no = $_SESSION['user_no'];
    $room_no = $_SESSION['room_no'];
    $conn->leave_room($user_no, $room_no);
}

@$user_id = $_POST['user_id'];
@$user_password = $_POST['user_password'];

$location = "";
if($conn->login($user_id, $user_password)){
    $location = "./roomList.html"; 
} else {
    $location = "./login.html"; 
}

?>
<script>
    location.href="<?php echo $location;?>";
</script>