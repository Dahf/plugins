<?php
session_start();
require("../rankmanager.php"); //Rankmanager importiert
if(isBanned($_SESSION["username"])){
  header("Location: ../login/logout.php"); //Falls er gebannt ist wird er ausgeloggt
  exit;
}
if(getRank($_SESSION["username"]) == USER){
  header("Location: ../login/dashboard.php"); //Wenn man USER ist wird man zurück geschickt
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
</head>
<body>
    <table>
    <tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Aktionen</th>
    </tr>

    <?php
    require("../mysql.php"); //MySQL wird importiert

    if(isset($_GET["del"])){ //Wenn er auf Delete drückt
        if(!empty($_GET["del"])){ //Wenn die Anfrage nicht leer ist/ Wenn es den Benutzer gibt
            $stmt = $mysql->prepare("DELETE FROM accounts WHERE ID = :id"); //Aus MySQL wird der Benutzer mit der ID :id gesucht
            $stmt->execute(array(":id" => $_GET["del"])); //Benutzer wird gelöscht
            }
            ?>
            <p>Der Benutzer wurde gelöscht</p>
            <?php
    }
    if(getRank($_SESSION["username"]) == ADMIN){
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE SERVERRANK != 2"); //Jeder Account wird ausgewählt der keine Admin-Rechte hat
    }
    if(getRank($_SESSION["username"]) == MOD){
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE SERVERRANK = 0"); //Jeder Account wird ausgewählt der User-Rechte
    }
    $stmt->execute(); //Das obere $stmt wird ausgeführt
    while($row = $stmt->fetch()){ //Für jeder Benutzer wird jeweils das da unten gemacht
        ?>
        <tr>
        <td><?php echo $row["id"] //Fragt die ID ab und gibt sie aus ?></td>
        <td><?php echo $row["USERNAME"] //Fragt den Username ab und gibt sie aus?></td>
        <td><?php echo $row["EMAIL"] //Fragt die EMAIL ab und gibt sie aus?></td>
        <td><a href="edit.php?id=<?php echo $row["id"] ?>"><i class="fas fa-edit"></i></a><a href="benutzer.php?del=<?php echo $row["id"] ?>"><i class="fas fa-user-minus"></i></a></td>

        </tr>
        <?php
    }
    ?>
    </table>
</body>
</html>
