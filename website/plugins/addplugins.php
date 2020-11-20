<?php
session_start();
require("../rankmanager.php");
if(isBanned($_SESSION["username"])){
  header("Location: logout.php");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plugin hinzufügen</title>
</head>
<body>
    <?php
    if(isset($_POST["submit"])){
        require("../mysql.php");

        $stmt = $mysql->prepare("INSERT INTO plugins (id, TITEL, DESCRIPTION, CREATED_BY, PICTURE) VALUES (0, :titel, :description, :by, :picture)");

        $stmt->bindParam(":titel", $_POST["titel"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
        $file_name = $_FILES['file']['name'];
        $file_tem_loc = $_FILES['file']['tmp_name'];
        $file_store = "../upload/".$file_name;
        $stmt->bindParam(":picture", $file_name, PDO::PARAM_STR);

        $stmt->bindParam(":by", $_SESSION['username'], PDO::PARAM_STR);
        $stmt->execute();
        if(move_uploaded_file($file_tem_loc, $file_store)){
        echo "Die News wurde erfolgreich hinzugefügt.";
        }

    }
    ?>
    <form action="?" method="post" enctype="multipart/form-data">
        <input type="text" name="titel" placeholder="Titel" required><br>
        <textarea name="description" cols="30" rows="10"></textarea><br>
        <input type="file" name="file"><br>
        <button type="submit" name="submit">Hinzufügen</button><br>
    </form>
</body>
</html>
