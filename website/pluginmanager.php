<?php

function getTitel($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["TITEL"];
}

function getDescription($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["DESCRIPTION"];
}

function getCreatedBy($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["CREATED_BY"];
}

function getPicture($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["PICTURE"];
}

function getPrice($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["PRICING"];
}

function getCategory($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["CATEGORY"];
}

function getDownload($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["DOWNLOAD"];
}

function getId($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["id"];
}
?>
