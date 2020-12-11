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
      <link href="../style/uebersicht.css" rel="stylesheet">
      <link rel="shortcut icon" href="../upload/plug.png">
  </head>
  <body>
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
  </body>
</html>
