<?php

require_once '../classes/database.php';

class box {
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
    public function insert($name, $img, $cal){
      try{
        $stmt = $this->conn->prepare("INSERT INTO box (name, img, cal, valid) VALUES (:name, :img, :cal, :valid)");
        $valid = 1;
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":img", $img);
        $stmt->bindparam(":cal", $cal);
        $stmt->bindparam(":valid", $valid);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($name, $img, $cal, $id){
        try{
          $stmt = $this->conn->prepare("UPDATE box SET name = :name, img = :img ,cal = :cal WHERE id = :id");
          $stmt->bindparam(":name", $name);
          $stmt->bindparam(":img", $img);
          $stmt->bindparam(":cal", $cal);
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
        $stmt = $this->conn->prepare("UPDATE box SET valid = 0 WHERE id = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    // Delete Forever
    // public function delete($id){
    //   try{
    //     $stmt = $this->conn->prepare("DELETE FROM box WHERE id = :id");
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
