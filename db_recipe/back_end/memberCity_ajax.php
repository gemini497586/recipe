<?php
require_once 'memberCrud.php';
$objUser = new Member();
$city = "SELECT * FROM db_recipe.city WHERE county='" . $_POST["countyNo"] . "'";
$stmt = $objUser->runQuery($city);
$stmt->execute();

// 選擇鄉鎮 <option> 全用 if else動態產生
if($stmt->rowCount() > 0){
    // 選擇鄉鎮區的第一個option
    // 用while echo 選擇鄉鎮區的第二項以後其他option
    echo "<option value=''>選擇鄉鎮區</option>";
    while($rowCity = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<option value='" . $rowCity["sn"] . "'>" . $rowCity["name"] . "</option>";
    }
}else{
    // 選擇鄉鎮 <option> 全都是動態產生
    // else echo 的用意是 避免先選擇台北市，反悔再選回預設的"選擇縣市"
    // 預設的<option value=''>選擇鄉鎮</option>會消失
    echo "<option value=''>選擇鄉鎮區</option>";
}
?>