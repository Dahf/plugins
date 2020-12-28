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
      <p>Hallo <b><?php echo $_SESSION["username"] ?></b></p>
      <?php if (getRank($_SESSION["username"]) == ADMIN){?>
        <p>Rank: <b>ADMIN</b></p>
      <?php } ?>
      <?php if (getRank($_SESSION["username"]) == MOD){?>
        <p>Rank: <b>MOD</b></p>
      <?php }?>
      <?php if (getRank($_SESSION["username"]) == USER){?>
        <p>Rank: <b>USER</b></p>
      <?php } ?>
      <p>Minecraft Account: <b><?php echo getMinecraft($_SESSION["username"]) ? getMinecraft($_SESSION["username"]) : "NICHT VERKNÜPFT";?></b></p>
      <p>In deiner Konto-Übersicht kannst du deine <a href="../benutzer/plugins.php">letzten Bestellungen</a> ansehen.</p>
    </div>
  </body>
</html>
