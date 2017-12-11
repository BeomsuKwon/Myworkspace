<?php
require("../conf/dbsettings.php");

class customer_info {
    private $id, $password;
    function hello(){
        echo "이야아아아아아아아<br>";
        echo "$this->customerid<br>";
        echo "$this->id<br>";
        echo "$this->password<br>";
        echo "$this->name<br>";
        echo "$this->level<br>";
        echo "$this->age<br>";
    }
}
$conn = new mysqli(DB_info::db_url, DB_info::user_id, DB_info::password, DB_info::db);
$result = $conn->query("SELECT * FROM customer");

$obj = $result->fetch_object("customer_info");

foreach($obj as $key => $value){
    echo "$key : $value<br>";
}
echo "<Br>";
$obj->hello();

echo "{$obj->id} {$obj->password}";