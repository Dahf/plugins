<?php
session_start();
 ?>
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
                 	<form method="post" action="stripe/checkout.php?action=add&id=<?php echo $row["id"]; ?>">
                   <img id="picture" src="upload/<?php echo $row["PICTURE"]?>">
                   <div id="header">
                     <a href="#" name="titel"><?php echo $row["TITEL"] ?></a>
                  </div>
                   <p id="status" name="created_by"><?php echo $row["CREATED_BY"] ?></p>
                   <p><?php echo ($row["DESCRIPTION"]) ?></p>
                   <p name="pricing"><?php echo ($row["PRICING"]) ?>€</p>
                   <input type="hidden" name="titel" value="<?php echo $row["TITEL"]; ?>" />
                   <input type="hidden" name="pricing" value="<?php echo $row["PRICING"]; ?>" />
                   <input type="text" name="quantity" class="form-control" value="1" />
                   <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                 </form>
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
