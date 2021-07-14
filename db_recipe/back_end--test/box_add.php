<?php
// Show PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once 'boxCrud.php';

$objUser = new box();
// GETconfirm
if (isset($_GET['edit_id'])) {
  $id = $_GET['edit_id'];
  $stmt = $objUser->runQuery("SELECT * FROM box WHERE id=:id");
  $stmt->execute(array(":id" => $id));
  $rowBox = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
  $id = null;
  $rowBox = null;
}

// POST
if (isset($_POST['btn_save'])) {
  //strip_tags()->消除 PHP 或 HTML 標籤符號
  $name   = strip_tags($_POST['name']);
  $img  = strip_tags($_POST['img']);
  $cal  = strip_tags($_POST['cal']);

  try {
    if ($objUser->insert($name, $img, $cal)) {
      $objUser->redirect('box_list.php?inserted');
    } else {
      $objUser->redirect('box_list.php?error');
    }
  } catch (PDOException $e) {
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
    <div class="row w-100 mx-0" style="width: 100wh;">
      <!-- Sidebar menu -->
      <?php require_once '../includes/sidebar.php'; ?>
      <!-- </nav> -->
      <main class="col w-100 bg-light">
        <h1 class="h2" style="margin-top: 16px">新增食材</h1>
        <p>(<span class="text-danger">*</span>)為必填資料</p>
        <form method="post" enctype="multipart/form-data">
          <!-- id -->
          <div class="form-group">
            <label for="id">id</label>
            <input class="form-control" type="text" name="id" id="id" readonly>
          </div>
          <!-- name -->
          <div class="form-group">
            <label for="name">食材名稱 <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" id="name" placeholder="請輸入食材名稱" required maxlength="100">
          </div>
          <!-- 食材圖片 -->
          <div class="form-group">
            <label for="img" class="form-label">食材圖片</label>
            <input class="form-control" type="file" id="img">
          </div>
          <!-- 卡路里 -->
          <div class="form-group">
            <label for="cal">卡路里 <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="cal" id="cal" placeholder="卡路里" required maxlength="100">
          </div>
          <!-- 對應商品 -->
          <!-- <div class="form-group">
                      <label for="productId">對應商品 <span class="text-danger">*</span></label>
                      <input  class="form-control" type="text" name="productId" id="productId" placeholder="對應商品" required maxlength="100">
                    </div> -->
          <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save">
        </form>
      </main>
    </div>
  </div>
  <!-- Footer scripts, and functions -->
  <?php require_once '../includes/footer.php'; ?>
</body>

</html>