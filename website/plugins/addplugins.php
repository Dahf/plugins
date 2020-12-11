<?php
session_start();
require("../rankmanager.php");
if(isBanned($_SESSION["username"])){
  header("Location: logout.php");
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plugin hinzufügen</title>
    <link rel="shortcut icon" href="../upload/plug.png">
</head>
<body>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
  document.Plugin.category.addEventListener('change', CheckAuswahl);

  function CheckAuswahl () {
    var menu = document.Plugin.category;
    document.querySelector('output').innerHTML = menu.options[menu.selectedIndex].value;
  }

});

</script>
    <?php
    if(isset($_POST["submit"])){
        require("../mysql.php");

        $stmt = $mysql->prepare("INSERT INTO plugins (id, TITEL, DESCRIPTION, CREATED_BY, PICTURE, PRICING, CATEGORY) VALUES (0, :titel, :description, :by, :picture, :pricing, :category)");
        $stmt->bindParam(":titel", $_POST["titel"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
        $file_name = $_FILES['file']['name'];
        $file_tem_loc = $_FILES['file']['tmp_name'];
        $file_store = "../upload/".$file_name;
        $stmt->bindParam(":picture", $file_name, PDO::PARAM_STR);
        $stmt->bindParam(":category", $_POST["category"], PDO::PARAM_STR);
        $stmt->bindParam(":pricing", $_POST["pricing"], PDO::PARAM_STR);
        $stmt->bindParam(":by", $_SESSION['username'], PDO::PARAM_STR);
        $stmt->execute();
        if(move_uploaded_file($file_tem_loc, $file_store)){
        echo "Die News wurde erfolgreich hinzugefügt.";
        }

    }
    ?>
    <form name="Plugin" action="?" method="post" enctype="multipart/form-data">
        <input type="text" name="titel" placeholder="Titel" required><br>
        <textarea name="description" cols="30" rows="10"></textarea><br>
        <input type="file" name="file"><br>
        <input type="text" name="pricing" placeholder="€" required><br>
        <label>Wähle die Category aus:
          <select name="category" size="2" required>
            <option value="spigot">Spigot</option>
            <option value="bungeecord">Bungeecord</option>
          </select>
        </label>
        <button type="submit" name="submit">Hinzufügen</button><br>
    </form>
</body>
</html>
