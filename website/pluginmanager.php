<?php

/*
* @author Silas Beckmann
* @return Gibt den Titel vom Plugin von der ID $id zurück
*
* Erhalte den Titel vom Plugin
*/
function getTitel($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["TITEL"];
}

/*
* @author Silas Beckmann
* @return Gibt die Description vom Plugin von der ID $id zurück
*
* Erhalte die Description vom Plugin
*/
function getDescription($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["DESCRIPTION"];
}

/*
* @author Silas Beckmann
* @return Gibt den Ersteller vom Plugin von der ID $id zurück
*
* Erhalte den Ersteller vom Plugin
*/
function getCreatedBy($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["CREATED_BY"];
}

/*
* @author Silas Beckmann
* @return Gibt den Dateien Name vom Bild von der ID $id zurück
*
* Erhalte den Dateien Name vom Bild des Plugin
*/
function getPicture($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["PICTURE"];
}
/*
* @author Silas Beckmann
* @return Gibt den Preis von der ID $id zurück
*
* Erhalte den Preis vom Bild des Plugin
*/
function getPrice($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["PRICING"];
}
/*
* @author Silas Beckmann
* @return Gibt gibt die Category von der ID $id zurück
*
* Erhalte die Category des Plugin
*/
function getCategory($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["CATEGORY"];
}
/*
* @author Silas Beckmann
* @return Gibt den Dateien Name vom Download von der ID $id zurück
*
* Erhalte den Dateien Name vom Download des Plugin
*/
function getDownload($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM plugins WHERE id = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["DOWNLOAD"];
}
