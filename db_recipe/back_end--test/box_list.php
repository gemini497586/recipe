<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'boxCrud.php';

//給p預設值
if(isset($_GET["p"])){
  $p=$_GET["p"];
}else{
  $p=1;
}

$per_page=5; //預設每筆頁數
$start_item=($p-1)*$per_page;  //本頁開始記錄筆數


$objUser = new box();

// GET
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    try{
        if($id != null){
            if($objUser->delete($id)){
                $objUser->redirect('box_list.php?deleted');
            }
        }else{
            var_dump($id);
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
    <style>
    figure{
        width: 200px;
        height: 120px;
        margin: 0 auto;
    }
    figure img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    </style>
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
          <h1 class="h2" style="margin-top: 16px">食材列表</h1>
          <?php
            if(isset($_GET['updated'])){
              echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
              <strong>食材<trong>更新成功!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"> &times; </span>
                </button>
              </div>';
            }else if(isset($_GET['deleted'])){
              echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
              <strong>食材<trong>刪除成功!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"> &times; </span>
                </button>
              </div>';
            }else if(isset($_GET['inserted'])){
              echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
              <strong>食材<trong>新增成功!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"> &times; </span>
                </button>
              </div>';
            }else if(isset($_GET['error'])){
              echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
              <strong>DB Error!<trong>部分出錯請再試一次!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"> &times; </span>
                </button>
              </div>';
            }
          ?>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                <th>ID</th>
                <th>食材名稱</th>
                <th>食材圖片</th>
                <th>卡路里</th>
                <th>功能</th>
                </tr>
              </thead>
              <?php
                $query = "SELECT * FROM box WHERE valid=1 ORDER BY id DESC LIMIT $start_item , $per_page";
                $stmt = $objUser->runQuery($query);
                $stmt->execute(); 

                $queryTotal="SELECT * FROM box WHERE valid=1";
                $stmtTotal = $objUser->runQuery($queryTotal);
                $stmtTotal->execute(); 

                $total=$stmtTotal->rowCount(); //總共筆數
                $pages=ceil($total/$per_page); //總頁數
              ?>
              <p>每頁顯示<?=$per_page?>筆資料，總共<?=$total?>筆資料</p>
              <tbody>
                <?php if($stmt->rowCount() > 0){
                  while($rowBox = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                  <td><?php print($rowBox['id']); ?></td>
                  <td>
                    <a href="box_edit.php?edit_id=<?php print($rowBox['id']); ?>">
                    <?php print($rowBox['name']); ?>
                    </a>
                  </td>
                  <td>
                  <figure>
                  <img src="../images/box/<?php print($rowBox['img']); ?>" alt="<?php print($rowBox['name']); ?>">
                  </figure>
                  </td>
                  <td><?php print($rowBox['cal']); ?></td>
                  <!-- <td><?php print($rowBox['product_id']); ?></td> -->
                  <td>
                    <a class="confirmation text-danger" href="box_list.php?delete_id=<?php print($rowBox['id']); ?>">
                    <span data-feather="trash"></span>
                    刪除
                    </a>
                  </td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php if($p>1) { ?>
              <li class="page-item">
                <a class="page-link" href="box_list.php?p=<?=$p-1?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php } ?>
              <?php for($i=1;$i<=$pages;$i++){ ?>
              <li class="page-item <?php if($i==$p){
                echo "active"; }?>"><a class="page-link" href="box_list.php?p=<?=$i?>"><?=$i?></a></li>
              <?php } ?>
              <?php if($p<$pages) { ?>
              <li class="page-item">
                <a class="page-link" href="box_list.php?p=<?=$p+1?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              <?php } ?>
            </ul>
          </nav>

        </main>
      </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once '../includes/footer.php'; ?>

    <!-- Custom scripts -->
    <script>
        // JQuery confirmation
        // $('.confirmation').on('click', function () {
        //     return confirm('確定要刪除這位使用者?');
        // });
    </script>
  </body>
</html>
