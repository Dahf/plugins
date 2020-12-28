<?php
session_start();
require("../rankmanager.php");
if(isBanned($_SESSION["username"])){
  header("Location: logout.php");
  exit;
}
if(getRank($_SESSION["username"]) == USER){
  header("Location: logout.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Benutzer bearbeiten</title>
  <link rel="shortcut icon" href="../upload/plug.png">
</head>
<body>
  <?php
  if(isset($_GET["id"])){
    if(!empty($_GET["id"])){ //Wenn es die ID gibt
      require("../mysql.php"); //MySQL importieren
      if(isset($_POST["submit"])){ //Wenn er auf Submit drückt
        $stmt = $mysql->prepare("UPDATE accounts SET USERNAME = :user, EMAIL = :email WHERE ID = :id"); //Erstellt den Account mit den Information die man ausgefüllt hat
        $stmt->execute(array(":user" => $_POST["username"], ":email" => $_POST["email"], ":id" => $_GET["id"])); //Führt die Aktion aus und senden es an die Datenbank
        header("Location: benutzer.php");
        ?>
        <p>Der Benutzer wurde gespeichert.</p>
        <?php
      }
      $stmt = $mysql->prepare("SELECT * FROM users WHERE ID = :id"); //Sucht nach den Benutzer mit der ID :id
      $stmt->execute(array(":id" => $_GET["id"])); //Variable :id wird vom Benutzer oben gesetzt
      $row = $stmt->fetch();
      ?>
      <form action="edit.php?id=<?php echo $_GET["id"] ?>" method="post">
        <input type="text" name="username" value="<?php echo $row["USERNAME"] ?>" placeholder="Benutzername" require><br>
        <input type="email" name="email" value="<?php echo $row["EMAIL"] ?>" placeholder="Email" require><br>
        <button name="submit" type="submit">Speichern</button>
      </form>
      <?php
    } else {
      ?>
      <p>Kein Benutzer wurde angefragt</p>
      <?php
    }
  } else {
    ?>
    <p>Kein Benutzer wurde angefragt</p>
    <?php
  }
  ?>
</body>
</html>
