<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'boxCrud.php';

$objUser = new box();
// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $objUser->runQuery("SELECT * FROM box WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowBox = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
    $id = null;
    $rowBox = null;
}

// POST
if(isset($_POST['btn_save'])){
    //strip_tags()->消除 PHP 或 HTML 標籤符號
    $name  = strip_tags($_POST['name']);
    $cal  = strip_tags($_POST['cal']);
    $img  = $_POST['img'];


    try{
        if($id != null){
        if($objUser->update($name, $img, $cal, $id)){
            $objUser->redirect('box_list.php?updated');
        }
        }else{
        if($objUser->insert($$name, $img, $cal)){
            $objUser->redirect('box_list.php?inserted');
        }else{
            $objUser->redirect('box_list.php?error');
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
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar menu -->
                <?php require_once '../includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <h1 class="h2" style="margin-top: 16px">編輯食材</h1>
                    <p>(<span class="text-danger">*</span>)為必填資料</p>
                    <form  method="post" enctype="multipart/form-data">
                        <!-- id -->
                        <div class="form-group">
                            <label for="id">id</label>
                            <input class="form-control" type="text" name="id" id="id" value="<?php print($rowBox['id']); ?>" readonly>
                        </div>
                        <!-- name -->
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="name" value="<?php print($rowBox['name']); ?>" required maxlength="100">
                        </div>
                        <!-- 食材圖片 -->
                        <div class="form-group">
                            <label for="img" class="form-label">食材圖片 </label>
                            <input class="form-control" type="file" id="img" name="img">
                        </div>
                        <!-- 卡路里 -->
                        <div class="form-group">
                            <label for="cal">卡路里 <span class="text-danger">*</span></label>
                            <input  class="form-control" type="text" name="cal" id="cal" placeholder="卡路里" value="<?php print($rowBox['cal']); ?>" required maxlength="100">
                        </div>
                        <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="更新">
                  </form>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once '../includes/footer.php'; ?>
    </body>
</html>
