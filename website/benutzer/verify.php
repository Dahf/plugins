<?php
session_start();
require("../rankmanager.php"); //Rankmanager importiert
if(isBanned($_SESSION["username"])){
  header("Location: ../login/logout.php"); //Falls er gebannt ist wird er ausgeloggt
  exit;
}
if(isset($_POST["submit"])){
    require("../mysql.php");

    $stmt = $mysql->prepare("UPDATE accounts SET MINECRAFT = :mc WHERE USERNAME = :name"); //Erstellt den Account mit den Information die man ausgefüllt hat
    $stmt->execute(array(":mc" => $_POST["minecraftname"], ":name" => $_SESSION["username"])); //Führt die Aktion aus und senden es an die Datenbank
    header("Location: ../login/uebersicht.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Verify</title>
  </head>
  <body>
    <div id="content">
      <form class="verify" action="verify.php" method="post">
          <input type="text" name="minecraftname" placeholder="Minecraft Name" required><br>
          <button type="submit" name="submit">Hinzufügen</button><br>
      </form>

    </div>
  </body>
</html>
