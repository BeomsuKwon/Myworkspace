<?php
class db_info {
    const   db_url      = "localhost",
            user_id     = 'root',
            passwd      = 'autoset',
            db          = 'ycj_test';
}

$conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);

if($conn->connect_errno) {
    exit("Failed to connect to MySQL: " . $conn->connect_error);
}

$res = $conn->query("SELECT * FROM customer");
$row = $res->fetch_assoc();
echo $row['id'];
?>