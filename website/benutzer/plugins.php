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
   $stmt = $mysql->prepare("SELECT * FROM orders WHERE BUYER="$_SESSION['username']" ");
   $stmt->execute();
   $count = $stmt->rowCount();
   if($count == 0){
       echo "Es wurden keine Plugins gefunden.";
   } else {
     ?>
        <ul>
          require(../pluginmanager.php)
     <?php
       while($row = $stmt->fetch()){
           ?>
               <li>
                 	<form method="post" action="stripe/checkout.php?action=add&id=<?php echo $row["id"]; ?>" target="_parent">
                   <img id="picture" src="upload/<?php echo $row["TITEL"] ?>/<?php echo $row["PICTURE"]?>">
                   <div id="header">
                     <a href="product.php?id=<?php echo $row["id"]; ?>" name="titel" target="_parent"><?php echo $row["TITEL"] ?></a>
                  </div>
                   <p id="status" name="created_by"><?php echo $row["CREATED_BY"] ?></p>
                   <p><?php echo ($row["DESCRIPTION"]) ?></p>
                   <p name="pricing"><?php echo ($row["PRICING"]) ?>€</p>
                   <input type="hidden" name="titel" value="<?php echo $row["TITEL"]; ?>" />
                   <input type="hidden" name="pricing" value="<?php echo $row["PRICING"]; ?>" />
                   <input type="text" name="quantity" class="txt-value" value="1" />
                   <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn-cart" value="Add to Cart" />
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