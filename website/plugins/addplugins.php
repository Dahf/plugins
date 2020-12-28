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
    <link href="../style/addplugins.css" rel="stylesheet">
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
      $stmt = $mysql->prepare("INSERT INTO plugins (id, TITEL, DESCRIPTION, CREATED_BY, PICTURE, PRICING, CATEGORY, DOWNLOAD) VALUES (0, :titel, :description, :by, :picture, :pricing, :category, :download)");
      $stmt->bindParam(":titel", $_POST["titel"], PDO::PARAM_STR);
      $stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
      $file_name = $_FILES['filepicture']['name'];
      $file_tem_loc = $_FILES['filepicture']['tmp_name'];
      $file_name2 = $_FILES['filedownload']['name'];
      $file_tem_loc2 = $_FILES['filedownload']['tmp_name'];
      if (!file_exists('../upload')) {
        mkdir('../upload', 0777, true);
      }
      if (!file_exists('../upload/'.$_POST["titel"])) {
        mkdir('../upload/'.$_POST["titel"], 0777, true);
      }
      $file_store = "../upload/".$_POST["titel"]."/".$file_name;
      $file_store2 = "../upload/".$_POST["titel"]."/".$file_name2;
      $stmt->bindParam(":picture", $file_name, PDO::PARAM_STR);
      $stmt->bindParam(":download", $file_name2, PDO::PARAM_STR);
      $stmt->bindParam(":category", $_POST["category"], PDO::PARAM_STR);
      $stmt->bindParam(":pricing", $_POST["pricing"], PDO::PARAM_STR);
      $stmt->bindParam(":by", $_SESSION['username'], PDO::PARAM_STR);
      $stmt->execute();
      if(move_uploaded_file($file_tem_loc, $file_store) && move_uploaded_file($file_tem_loc2, $file_store2)){
        echo "Die News wurde erfolgreich hinzugefügt.";
      }
    }
    ?>
    <div id="table">
      <form name="Plugin" action="?" method="post" enctype="multipart/form-data">
        <input type="text" name="titel" placeholder="Titel" required><br>
        <textarea name="description" cols="30" rows="10" maxlength="49"></textarea><br>
        <input type="file" name="filepicture" placeholder="Picture"><br>
        <input type="file" name="filedownload" placeholder="Plugin"><br>
        <input type="text" name="pricing" placeholder="€" required><br>
        <label>Wähle die Category aus:
          <select name="category" size="2" required>
            <option value="spigot">Spigot</option>
            <option value="bungeecord">Bungeecord</option>
          </select>
        </label>
        <button type="submit" name="submit">Hinzufügen</button><br>
      </form>
    </div>
  </body>
</html>
