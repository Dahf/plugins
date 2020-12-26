<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit;
}
require("../rankmanager.php");
require("../minecraftmanager.php");
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
      <link href="../style/uebersicht.css" rel="stylesheet">
      <link rel="shortcut icon" href="../upload/plug.png">
  </head>
  <body>
    <div id="content">
    <p>Token: <?php echo getToken($_SESSION["username"]) ? getToken($_SESSION["username"]) : "NICHT VERKNÜPFT";?></b></p>
    <p>Man muss auf seinen Server joinen und "/verify [Token]" schreiben, <br> damit überprüft wird, ob sie eine Lizenz haben. </p>
    <a href="../upload/beispiel.txt"download>VerifyManager</a>
    </div>
  </body>
</html>
