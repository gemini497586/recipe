<?php

$servername = "localhost"; 
$username = "admin"; 
$password = "12345"; 
$dbname = "db_recipe";

date_default_timezone_set("Asia/Taipei");

try {
    $db_host = new PDO(
        "mysql:host = {$servername}; dbname = {$dbname};charset = utf8",
        $username, $password    
    );
    // echo "pdo_connect_recipe.php 資料庫連結成功 <br>";
} catch (PDOException $e) {
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e -> getMessage(). "<br>";
    exit;
}



// $db_host = null;//關閉資料庫連結
?>
