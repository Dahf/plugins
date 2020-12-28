<?php
session_start();
require("../rankmanager.php"); //Rankmanager importiert
if(isBanned($_SESSION["username"])){
  header("Location: ../login/logout.php"); //Falls er gebannt ist wird er ausgeloggt
  exit;
}
?>
<html>
<head>
  <meta charset="utf-8">
  <link href="../style/plugins.css" rel="stylesheet">
  <link rel="shortcut icon" href="upload/plug.png">
</head>
<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
  <div class="separator">Deine Plugins</div>
  <div id="projects">
    <?php
    require("../mysql.php");
    require("../pluginmanager.php");
    $stmt = $mysql->prepare("SELECT * FROM orders WHERE BUYER=:user ");
    $stmt->bindParam(":user", $_SESSION["username"], PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      ?>
      <div class="noplugins">
        <?php echo "Es wurden keine Bestellungen gefunden."; ?>
      </div>
      <?php
    } else {
      ?>


      <ul>
        <?php
        while($row = $stmt->fetch()){
          ?>
          <div id="plugins">
            <li>
              <div class="ordernumber"> <?php echo $row["ORDERNUMBER"] ?></div>
              <div class="titel"><?php echo getTitel($row["PLUGINID"])?></div>
              <div class="download"><a href="../upload/<?php echo getTitel($row["PLUGINID"]) ?>/<?php echo getDownload($row["PLUGINID"]) ?>"download>
                <i class="fas fa-download"></i></div>
              </a>
            </form>
          </li>
        </div>
        <?php
      }
      ?>
    </ul>
    <?php
  }
  ?>
</div>
</body>
</html>
