<html>
    <head>
        <meta charset="utf-8">
        <link href="style/news.css" rel="stylesheet">
    </head>
    <body>
        <div class="separator">MOST POPULAR</div>
          <div id="projects">
  <?php
   require("mysql.php");
   $stmt = $mysql->prepare("SELECT * FROM plugins ORDER BY id DESC LIMIT 9");
   $stmt->execute();
   $count = $stmt->rowCount();
   if($count == 0){
       echo "Es wurden keine News gefunden.";
   } else {
     ?>
        <ul>
     <?php
       while($row = $stmt->fetch()){
           ?>

               <li>
                   <img id="picture" src="upload/<?php echo $row["PICTURE"]?>">
                   <div id="header">
                     <a href="#"><?php echo $row["TITEL"] ?></a>
                  </div>
                   <p id="status"><?php echo $row["CREATED_BY"] ?></p>
                   <p><?php echo ($row["DESCRIPTION"]) ?></p>
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
