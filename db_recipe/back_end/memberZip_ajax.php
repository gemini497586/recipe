<?php
require_once 'memberCrud.php';
$objUser = new Member();
$zip = "SELECT * FROM db_recipe.city WHERE sn='" . $_POST["cityNo"] . "'";
$stmt = $objUser->runQuery($zip);
$stmt->execute();
if($stmt->rowCount() > 0){
    $rowZip = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $rowZip["zipcode"];
} else {
    echo "無資料";
}
?>

