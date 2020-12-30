<?php
/*
* @author Silas Beckmann
* @return Gibt gibt den Minecraft-Namen vom Nutzer $mc zurück
*
* Erhalte den Minecraft-Namen
*/
function getMinecraft($mc){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :name");
  $stmt->execute(array(":name" => $mc));
  $row = $stmt->fetch();
  return $row["MINECRAFT"];
}
/*
* @author Silas Beckmann
* @return Gibt gibt den Token vom Nutzer $mc zurück
*
* Erhalte den Token
*/
function getToken($mc){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :name");
  $stmt->execute(array(":name" => $mc));
  $row = $stmt->fetch();
  return $row['TOKEN'];
}
?>
