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
