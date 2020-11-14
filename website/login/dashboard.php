<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit;
}
require("../rankmanager.php");
if(isBanned($_SESSION["username"])){
  header("Location: logout.php");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Dashboard</h1>
    <a href="../plugins/addplugins.php">Plugins</a>
    <a href="../benutzer/benutzer.php">Benutzer</a>
    <a href="logout.php">Abmelden</a>
  </body>
</html>
