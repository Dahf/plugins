<?php
session_start();
 ?>
 <html>
    <head>
        <meta charset="utf-8">
        <link href="../style/spigot.css" rel="stylesheet">
        <link rel="shortcut icon" href="upload/plug.png">
    </head>
    <body>
        <div class="separator">Deine Plugins</div>
          <div id="projects">
  <?php
   require("../mysql.php");
   $stmt = $mysql->prepare("SELECT * FROM orders WHERE BUYER=:user ");
   $stmt->bindParam(":user", $_SESSION["username"], PDO::PARAM_STR);
   $stmt->execute();
   $count = $stmt->rowCount();
   if($count == 0){
       echo "Es wurden keine Plugins gefunden.";
   } else {
     ?>
        <ul>
     <?php
       while($row = $stmt->fetch()){
           ?>
               <li>
                 <?php echo $row["ORDERNUMBER"] ?>
                 <?php echo $row["PLUGINID"] ?>
               </li>
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
