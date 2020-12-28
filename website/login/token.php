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
    <h1>Verify-Manager</h1>
    <p>Du hast ein Plugin gekauft?<br>Lade dier hier noch den <a href="../upload/VerifyManager.jar"download>VerifyManager</a> herunter und lade diesen auf den Server hoch. <br> Schreibe danach im Chat <a>/verify <?php echo getToken($_SESSION["username"]) ? getToken($_SESSION["username"]) : "NICHT VERKNÜPFT";?></a> <br> damit überprüft wird, ob sie eine gültige Lizenz haben. </p>

  </div>
</body>
</html>
