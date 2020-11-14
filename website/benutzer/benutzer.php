<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzerverwaltung</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
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
    require("../mysql.php");

    if(isset($_GET["del"])){
        if(!empty($_GET["del"])){
            $stmt = $mysql->prepare("DELETE FROM accounts WHERE ID = :id");
            $stmt->execute(array(":id" => $_GET["del"]));
            ?>
            <p>Der Benutzer wurde gelöscht</p>
            <?php
        }
    }

    $stmt = $mysql->prepare("SELECT * FROM accounts");
    $stmt->execute();
    while($row = $stmt->fetch()){
        ?>
        <tr>
        <td><?php echo $row["id"] ?></td>
        <td><?php echo $row["USERNAME"] ?></td>
        <td><?php echo $row["EMAIL"] ?></td>
        <td><a href="edit.php?id=<?php echo $row["id"] ?>"><i class="fas fa-edit"></i></a><a href="benutzer.php?del=<?php echo $row["id"] ?>"><i class="fas fa-user-minus"></i></a></td>

        </tr>
        <?php
    }
    ?>
    </table>
</body>
</html>
