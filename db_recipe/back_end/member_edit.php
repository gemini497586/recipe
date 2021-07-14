<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'memberCrud.php';

$objUser = new Member();
// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $objUser->runQuery("SELECT * FROM db_recipe.member WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowMember = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $id = null;
  $rowMember = null;
}

// POST
if(isset($_POST['btn_save'])){
  //strip_tags()->消除 PHP 或 HTML 標籤符號
  $name   = strip_tags($_POST['name']);
  $nickname  = strip_tags($_POST['nickname']);
  $account  = strip_tags($_POST['account']);
  $password  = strip_tags($_POST['password']);
  $gender  = strip_tags($_POST['gender']);
  $birthday  = strip_tags($_POST['birthday']);
  $phone  = strip_tags($_POST['phone']);
  $email  = strip_tags($_POST['email']);
  $address  = strip_tags($_POST['address']);
  $target = "../images/member/".$_FILES['picture']['name'];

  if($_FILES['picture']['error'] == 0){
    if(move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
      echo "Upload success!<br>";
    } else {
      echo "Upload fail!<br>";
    }
  }
  $picture = $_FILES['picture']['name'];

  try{
     if($id != null){
       if($objUser->update($name, $nickname, $account, $password, $gender, $birthday, $phone, $email, $address, $picture, $id)){
         $objUser->redirect('member_list.php?updated');
       }
     }else{
       if($objUser->insert($name, $nickname, $account, $password, $gender, $birthday, $phone, $email, $address, $picture)){
         $objUser->redirect('member_list.php?inserted');
       }else{
         $objUser->redirect('member_list.php?error');
       }
     }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once '../includes/head.php'; ?>
    </head>
    <body>
      <!-- Header banner -->
        <?php require_once '../includes/header.php'; ?>
      <!--contect-->
      <div class="container-fluid position-absolute px-0">
        <div class="row w-100 mx-0"  style="width: 100wh;">
          <!-- Sidebar menu -->
            <?php require_once '../includes/sidebar.php'; ?>
          <!-- </nav> -->
          <main class="col w-100 bg-light">
                  <h1 class="h2" style="margin-top: 16px">編輯會員</h1>
                  <p>(<span class="text-danger">*</span>)為必填資料</p>
                  <form  method="post" enctype="multipart/form-data">
                    <!-- id -->
                    <div class="form-group">
                      <label for="id">id</label>
                      <input class="form-control" type="text" name="id" id="id" value="<?php print($rowMember['id']); ?>" readonly>
                    </div>
                    <!-- name -->
                    <div class="form-group">
                      <label for="name">Name <span class="text-danger">*</span></label>
                      <input  class="form-control" type="text" name="name" id="name" placeholder="請輸入真實姓名" value="<?php print($rowMember['name']); ?>" required maxlength="100">
                    </div>
                    <!-- 大頭貼 -->
                    <div class="form-group">
                      <label for="picture">大頭貼</label>
                      <input type="file" name="picture" id="picture" class="btn" accept="image/*"> 
                      <div class="box120 position-absolute">
                          <img src="../images/member/<?=$result['image']?>" alt="">
                      </div>
                    </div>
                    <!-- 帳號 -->
                    <div class="form-group">
                      <label for="account">帳號 <span class="text-danger">*</span></label>
                      <input  class="form-control" type="text" name="account" id="account" placeholder="帳號" value="<?php print($rowMember['account']); ?>" required maxlength="100">
                    </div>
                    <!-- 密碼 -->
                    <div class="form-group">
                      <label for="password">密碼 <span class="text-danger">*</span></label>
                      <input  class="form-control" type="text" name="password" id="password" placeholder="密碼" value="<?php print($rowMember['password']); ?>" required maxlength="100">
                    </div>
                    <!-- 確認密碼 -->
                    <!-- 暱稱 -->
                    <div class="form-group">
                      <label for="nickname">暱稱</label>
                      <input  class="form-control" type="text" name="nickname" id="nickname" placeholder="nickname" value="<?php print($rowMember['nickname']); ?>"  maxlength="100">
                    </div>
                    <!-- 性別 -->
                    <div class="form-group">
                      <label for="">性別<span class="text-danger">*</span></label>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="男" <?php if($rowMember['gender'] == '男'){echo 'checked';} ?>>
                        <label class="form-check-label" for="inlineRadio1">男</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="女" <?php if($rowMember['gender'] == '女'){echo 'checked';} ?>>
                        <label class="form-check-label" for="inlineRadio2">女</label>
                      </div>
                    </div>
                    <!-- 生日 -->
                    <div class="form-group">
                      <label for="birthday">生日 <span class="text-danger">*</span></label>
                      <input  class="form-control" type="text" name="birthday" id="birthday" placeholder="yyyy-MM-dd" value="<?php print($rowMember['birthday']); ?>" required maxlength="10">
                    </div>
                    <!-- 電話 -->
                    <div class="form-group">
                      <label for="phone">電話</label>
                      <input  class="form-control" type="text" name="phone" id="phone" placeholder="phone" value="<?php print($rowMember['phone']); ?>"  maxlength="100">
                    </div>
                    <!-- email -->
                    <div class="form-group">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <input  class="form-control" type="text" name="email" id="email" placeholder="johndoel@gmail.com" value="<?php print($rowMember['email']); ?>" required maxlength="100">
                    </div>
                    <!-- 地址 -->
                    <div class="form-group">
                      <label for="">地址</label>
                      <input type="text" class="mb-3 form-control" name="address" id="myAddress"  maxlength="100" readonly>
                      <div class="form-row">
                        <div class="form-group col-md-2">
                          <input type="text" class="form-control" id="myZip" Name="zipcode" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <select class="custom-select" name="countyNo" id="myCounty">
                            <option selected>選擇縣市</option>
                            <?php
                            $county = "SELECT * FROM db_recipe.county";
                            $stmt = $objUser->runQuery($county);
                            $stmt->execute();
                            if($stmt->rowCount() > 0){
                              while($rowCounty = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $rowCounty["sn"] ?>"><?php echo $rowCounty["name"]; ?></option>
                            <?php }} ?>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="custom-select" name="cityNo" id="myCity">
                              <option value="">選擇鄉鎮區</option>
                          </select>
                        </div>
                      </div>
                      <input type="text" class="form-control" name="else_address" id="elseAddress"/>                    
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="儲存">
                  </form>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once '../includes/footer.php'; ?>
        <script>
          //用jQuery的ajax把縣市編號(countyNo)傳到memberCity_ajax.php
          //回傳相對應的"鄉鎮名稱"後，echo 選擇鄉鎮區的下拉選單<option>
          $('#myCounty').change(function(){
              var countyNo= $('#myCounty').val();
              $.ajax({
                  type: "POST",
                  url: 'memberCity_ajax.php',
                  cache: false,
                  data:'countyNo='+countyNo,
                  error: function(){
                      alert('Ajax request 發生錯誤');
                  },
                  success: function(data){
                      $('#myCity').html(data);
                      $('#myZip').val("");//避免重新選擇縣市後郵遞區號還存在，所以在重新選擇縣市後郵遞區號欄位清空
                  }
              });
          });

          //把"選出來的鄉鎮區"的編號，傳到memberZip_ajax.php
          //再將對應的郵遞區號echo到郵遞區號欄位
          $('#myCity').change(function(){
              var cityNo= $('#myCity').val();
              $.ajax({
                  type: "POST",
                  url: 'memberZip_ajax.php',
                  cache: false,
                  data:'cityNo='+cityNo,
                  error: function(){
                      alert('Ajax request 發生錯誤');
                  },
                  success: function(data){
                      $('#myZip').val(data);
                  }
              });
          });

          let countyName = '';
          let cityName = '';
          let elseAddress = '';
          let content = countyName+cityName+elseAddress;
          $('#myCounty').change(function(){
            countyName = $('#myCounty').find(':selected').text();
            content = countyName+cityName+elseAddress;
            $('#myAddress').val(content);
          });
          $('#myCity').change(function(){
            cityName = $('#myCity').find(':selected').text();
            content = countyName+cityName+elseAddress;
            $('#myAddress').val(content);
          });
          $('#elseAddress').keyup(function(){
            elseAddress = $('#elseAddress').val();
            content = countyName+cityName+elseAddress;
            $('#myAddress').val(content);
          });
        </script>
    </body>
</html>
