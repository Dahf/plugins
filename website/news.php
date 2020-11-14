<html>
    <head>
        <meta charset="utf-8">
        <link href="style/news.css" rel="stylesheet">
    </head>
    <body>
        <div class="separator">MOST POPULAR</div>
  <?php
   require("mysql.php");
   $stmt = $mysql->prepare("SELECT * FROM plugins ORDER BY CREATED_AT DESC LIMIT 3");
   $stmt->execute();
   $count = $stmt->rowCount();
   if($count == 0){
       echo "Es wurden keine News gefunden.";
   } else {
       while($row = $stmt->fetch()){
           ?>
           <ul>
               <li>
                   <b id="header"><?php echo $row["TITEL"] ?></b>
                   <p id="status"><?php echo date("d.m.Y H:i", $row["CREATED_AT"]) ?></p>
                   <p><?php echo ($row["DESCRIPTION"]) ?></p>
           <?php
       }
   }
   ?>

    </body>
</html>
