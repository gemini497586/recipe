<?php
$servername = "localhost"; 
$username = "admin"; 
$password = "12345"; 
$dbname = "db_recipe";

date_default_timezone_set("Asia/Taipei");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname); 
//檢查連線
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error); 
}
// echo "連線成功";


?>