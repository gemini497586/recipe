<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'memberCrud.php';

//給p預設值
if(isset($_GET["p"])){
  $p=$_GET["p"];
}else{
  $p=1;
}

$per_page=10; //預設每筆頁數
$start_item=($p-1)*$per_page;  //本頁開始記錄筆數

$objUser = new Member();

//POST
if(isset($_POST['delete_data'])){
  $id = $_POST['delete_id'];
  try{
    if($id != null){
      if($objUser->delete($id)){
        $objUser->redirect('member_list.php?deleted');
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
          <h1 class="h2" style="margin-top: 16px">會員列表</h1>

          <?php
            if(isset($_GET['updated'])){
              echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
              <strong>會員<trong>更新成功!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"> &times; </span>
                </button>
              </div>';
            }else if(isset($_GET['deleted'])){
              echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
              <strong>會員<trong>刪除成功!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"> &times; </span>
                </button>
              </div>';
            }else if(isset($_GET['inserted'])){
              echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
              <strong>會員<trong>新增成功!
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
                  <th>id</th>
                  <th>姓名</th>
                  <th>暱稱</th>
                  <th>使用者帳號</th>
                  <th>密碼</th>
                  <th>性別</th>
                  <th>生日</th>
                  <th>電話</th>
                  <th>電子信箱</th>
                  <th>功能</th>
                </tr>
              </thead>
              <?php
                $query = "SELECT * FROM db_recipe.member WHERE valid = 1 ORDER BY id DESC LIMIT $start_item , $per_page";
                $stmt = $objUser->runQuery($query);
                $stmt->execute();

                $queryTotal="SELECT * FROM db_recipe.member WHERE valid=1";
                $stmtTotal = $objUser->runQuery($queryTotal);
                $stmtTotal->execute(); 

                $total=$stmtTotal->rowCount(); //總共筆數
                $pages=ceil($total/$per_page); //總頁數
              ?>
              <p>每頁顯示<?=$per_page?>筆資料，總共<?=$total?>筆資料</p>
              <tbody>
                <?php if($stmt->rowCount() > 0){
                  while($rowMember = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                  <td><?php print($rowMember['id']); ?></td>
                  <td><?php print($rowMember['name']); ?></td>
                  <td><?php print($rowMember['nickname']); ?></td>
                  <td><?php print($rowMember['account']); ?></td>
                  <td><?php print($rowMember['password']); ?></td>
                  <td><?php print($rowMember['gender']); ?></td>
                  <td><?php print($rowMember['birthday']); ?></td>
                  <td><?php print($rowMember['phone']); ?></td>
                  <td><?php print($rowMember['email']); ?></td>
                  <td>
                    <a class="btn btn-sm btn-primary" href="member_edit.php?edit_id=<?php print($rowMember['id']); ?>">編輯</a>
                    <button type="button" class="btn btn-sm btn-danger delBtn" data-toggle="modal" data-target="#delModal">刪除</button>
                  </td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
          <!-- 刪除 Modal -->
          <?php require_once 'member_modal_del.php'; ?>
          <!-- 分頁bar -->
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php if($p>1) { ?>
              <li class="page-item">
                <a class="page-link" href="member_list.php?p=<?=$p-1?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php } ?>
              <?php for($i=1;$i<=$pages;$i++){ ?>
              <li class="page-item <?php if($i==$p){
                echo "active"; }?>"><a class="page-link" href="member_list.php?p=<?=$i?>"><?=$i?></a></li>
              <?php } ?>
              <?php if($p<$pages) { ?>
              <li class="page-item">
                <a class="page-link" href="member_list.php?p=<?=$p+1?>" aria-label="Next">
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
      // 刪除
      $('.delBtn').on('click', function(){
        let data = $(this).closest('tr').children('td').map(function(){
          return $(this).text();
        }).get();

        // data[0] = 刪除目標的id
        $('#delete_id').val(data[0]); 
      })
    </script>
  </body>
</html>
