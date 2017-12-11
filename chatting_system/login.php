<?php
require("../models/model_chatting_system.php");

@$user_id = $_POST['user_id'];
@$user_password = $_POST['user_password'];

$conn = new ChattingSystemModel();

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