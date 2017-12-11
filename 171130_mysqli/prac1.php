<?php
require("../conf/dbsettings.php");

$conn = new mysqli(DB_info::db_url, DB_info::user_id, DB_info::password, DB_info::db);

if ($conn->connect_errno) {
    echo "Failed to Connect with MySQLi : " . $conn->connect_errno;
}

if(!$result = $conn->query("SELECT * FROM customer")){
    exit("query syntax error");
}

echo "Current field : {$result->current_field}<br>";
echo "Field count : {$result->field_count}<br>";
echo "Num rows : {$result->num_rows}<br>";

echo "<br><br>Before \$result->fetch_array()<br>Num rows: {$result->num_rows}<br><br>";

$record_1 = $result->fetch_array();

for($i = 0; $i < $result->field_count; $i++){
    echo "{$record_1[$i]} | &nbsp";
}

echo "<br><br>Length count: <br>";
foreach( $result->lengths as $i => $val ){
    printf("Field %2d gas Length %2d<br>", $i + 1, $val);
}

echo "<br><br>After \$result->fetch_array()<br>Num rows: {$result->num_rows}<br><br>";

if(!$result = $conn->query("SELECT * FROM customer")){
    exit("query syntax error");
}

$record_2 = $result->fetch_assoc();
echo "{$record_2['id']} | &nbsp {$record_2['name']} | &nbsp {$record_2['age']}";

echo "<br><br>After \$result->fetch_assoc()<br>Num rows: {$result->num_rows} <br><br>";

if(!$result = $conn->query("SELECT * FROM customer")){
    exit("query syntax error");
}

$record_3 = $result->fetch_row();
echo "{$record_3[0]} | &nbsp {$record_3[1]} | &nbsp {$record_3[2]}";

echo "<br><br>After \$result->fetch_row() <br>Num rows: {$result->num_rows} <br><br>";

$result->free();

if(!$result = $conn->query("SELECT * FROM customer")){
    exit("query syntax error");
}

$records = $result->fetch_all();

$row_num = count($records);
$col_num = isset($records[0]) ? count($records[0]) : 0;

for($row_count = 0; $row_count < $row_num; $row_count++){
    for($col_count = 0; $col_count < $col_num; $col_count++){
        echo "[{$row_count}][{$col_count}]: {$records[$row_count][$col_count]}<br>";
    }
    echo "<br>";
}

unset($record);
$result->free();