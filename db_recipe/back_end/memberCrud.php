<?php

require_once '../classes/database.php';

class Member {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }


    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($name, $nickname, $account, $password, $gender, $birthday, $phone, $email, $address, $picture){
      try{
        $stmt = $this->conn->prepare("INSERT INTO db_recipe.member (name, nickname, account, password, gender, birthday, phone, email, address, picture, create_date, valid) VALUES (:name, :nickname, :account, :password, :gender, :birthday, :phone, :email, :address, :picture, :create_date, :valid)");
        $create_date = date('Y-m-d H:i:s');
        $valid = 1;
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":nickname", $nickname);
        $stmt->bindparam(":account", $account);
        $stmt->bindparam(":password", $password);
        $stmt->bindparam(":gender", $gender);
        $stmt->bindparam(":birthday", $birthday);
        $stmt->bindparam(":phone", $phone);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":address", $address);
        $stmt->bindparam(":picture", $picture);
        $stmt->bindparam(":create_date", $create_date);
        $stmt->bindparam(":valid", $valid);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($name, $nickname, $account, $password, $gender, $birthday, $phone, $email, $address, $picture, $id){
        try{
          $stmt = $this->conn->prepare("UPDATE db_recipe.member SET name = :name, nickname = :nickname, account = :account, password = :password, gender = :gender, birthday = :birthday, phone = :phone, email = :email, address = :address, picture = :picture WHERE id = :id");
          $stmt->bindparam(":name", $name);
          $stmt->bindparam(":nickname", $nickname);
          $stmt->bindparam(":account", $account);
          $stmt->bindparam(":password", $password);
          $stmt->bindparam(":gender", $gender);
          $stmt->bindparam(":birthday", $birthday);
          $stmt->bindparam(":phone", $phone);
          $stmt->bindparam(":email", $email);
          $stmt->bindparam(":address", $address);
          $stmt->bindparam(":picture", $picture);
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }


    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("UPDATE db_recipe.member SET valid = 0 WHERE id = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    // // Delete forever
    // public function delete($id){
    //   try{
    //     $stmt = $this->conn->prepare("DELETE FROM db_recipe.member WHERE id = :id");
    //     $stmt->bindparam(":id", $id);
    //     $stmt->execute();
    //     return $stmt;
    //   }catch(PDOException $e){
    //       echo $e->getMessage();
    //   }
    // }

    // Redirect URL method
    public function redirect($url){
      header("Location: $url");
    }
}
?>
