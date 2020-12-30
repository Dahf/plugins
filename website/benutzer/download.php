<?php
session_start();

require("../rankmanager.php");
require("../mysql.php");
require("../pluginmanager.php");

if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit;
}
if(isBanned($_SESSION["username"])){
  header("Location: logout.php");
  exit;
}
/*
* @author Silas Beckmann
* @return Download File von id
*
* Das Lizenzsystem versucht auf dieser Seite alle Plugins zu downloaden
* falls der Nutzer das Plugin hat wird die Datei automatisch auf den Server geladen
* dies in noch in Arbeit deshalb kann man auch noch download.php benutzen
*/
$stmt = $mysql->prepare("SELECT * FROM orders WHERE BUYER=:user AND PLUGINID=:id");
$stmt->bindParam(":user", $_SESSION["username"], PDO::PARAM_STR);
$stmt->bindParam(":id", $_GET["id"], PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();
if($count != 0){
  $file_url = '../upload/'.getTitel($_GET["id"]).'/'.getDownload($_GET["id"]);
  header('Content-Type: application/octet-stream');
  header("Content-Transfer-Encoding: Binary");
  header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
  readfile($file_url);
}
