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
        $stmt = $mysql->prepare("INSERT INTO plugins (id, TITEL, DESCRIPTION, CREATED_AT) VALUES (0, :titel, :description, :now)");
        $stmt->bindParam(":titel", $_POST["titel"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
        $now = time();
        $stmt->bindParam(":now", $now, PDO::PARAM_STR);
        $stmt->execute();
        echo "Die News wurde erfolgreich hinzugefügt.";

    }
    ?>
    <form action="addplugins.php" method="post">
        <input type="text" name="titel" placeholder="Titel" required><br>
        <textarea name="description" cols="30" rows="10"></textarea><br>
        <button type="submit" name="submit">Hinzufügen</button><br>
    </form>
</body>
</html>
