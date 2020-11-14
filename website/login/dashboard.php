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
    <title>Dashboard</title>
    <link href="../style/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <div class="sidebar">
    <a href="../index.php" class="pluginstore">PluginStore</a>
    <hr>
    <h2 id="dashboard">Dashboard</h2>
    <div class="buttonlist">
    <ul>
    <li><a href="../plugins/addplugins.php" class="button">Plugins</a></li>
    <li><a href="../benutzer/benutzer.php" class="button">Benutzer</a></li>
    <li><a href="logout.php" class="button">Abmelden</a></li>
  </ul>
  </div>
  </div>
  </body>
</html>
