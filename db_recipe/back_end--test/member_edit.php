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

  try{
     if($id != null){
       if($objUser->update($name, $nickname, $account, $password, $gender, $birthday, $phone, $email, $id)){
         $objUser->redirect('member_list.php?updated');
       }
     }else{
       if($objUser->insert($name, $nickname, $account, $password, $gender, $birthday, $phone, $email)){
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
                  <form  method="post">
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
                      <label for="picture" class="form-label">大頭貼</label>
                      <input class="form-control" type="file" id="picture">
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
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="男">
                        <label class="form-check-label" for="inlineRadio1">男</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="女">
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
                      <input  class="form-control" type="text" name="phone" id="phone" placeholder="09" value="<?php print($rowMember['phone']); ?>"  maxlength="100">
                    </div>
                    <!-- email -->
                    <div class="form-group">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <input  class="form-control" type="text" name="email" id="email" placeholder="johndoel@gmail.com" value="<?php print($rowMember['email']); ?>" required maxlength="100">
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save">
                  </form>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once '../includes/footer.php'; ?>
    </body>
</html>
