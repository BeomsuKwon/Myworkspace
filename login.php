<?php
session_start();
$id = "";
$passwd = "";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $passwd = $_POST['passwd'];
} else {
    session_destroy();
    echo "<script>javascript:history.back();</script>";
}

if ($id == "ppomi" && $passwd == "ppomi") {
    $_SESSION['id'] = "ppomi";
    echo "<script>javascript:history.back();</script>";
}


?>