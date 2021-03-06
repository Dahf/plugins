<?php
session_start();
require("../rankmanager.php");
if(isBanned($_SESSION["username"])){
  header("Location: ../login/logout.php");
  exit;
}
if(getRank($_SESSION["username"]) == USER){
  header("Location: ../login/dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzerverwaltung</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
    <link rel="shortcut icon" href="../upload/plug.png">
    <link href="../style/benutzer.css" rel="stylesheet">
  </head>
  <body>
    <div id="head">
      <table>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Aktionen</th>
        </tr>
        <?php
        require("../mysql.php");
        if(isset($_GET["del"])){
          if(!empty($_GET["del"])){
            $stmt = $mysql->prepare("DELETE FROM accounts WHERE ID = :id");     // stmt wird vorbereitet um Benutzer mit der :id zu löschen
            $stmt->execute(array(":id" => $_GET["del"]));
          }
        ?>
          <p>Der Benutzer wurde gelöscht</p>
        <?php
        }
        if(getRank($_SESSION["username"]) == ADMIN){
          $stmt = $mysql->prepare("SELECT * FROM accounts WHERE SERVERRANK != 2");// Jeder Account wird ausgewählt der keine Admin-Rechte hat
        }
        if(getRank($_SESSION["username"]) == MOD){
          $stmt = $mysql->prepare("SELECT * FROM accounts WHERE SERVERRANK = 0");// Jeder Account wird ausgewählt der User-Rechte
        }
        $stmt->execute();
        while($row = $stmt->fetch()){                                           // Für jeden ausgewählten Nutzer
        ?>
          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["USERNAME"]?></td>
            <td><?php echo $row["EMAIL"]?></td>
            <td><a href="edit.php?id=<?php echo $row["id"] ?>"><i class="fas fa-edit"></i></a><a href="benutzer.php?del=<?php echo $row["id"] ?>"><i class="fas fa-user-minus"></i></a></td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>
  </body>
</html>
