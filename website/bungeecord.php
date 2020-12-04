<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Bungeecord</title>
    <link href="style/bungeecord.css" rel="stylesheet">
  </head>
  <body>
<!---------------- JAVASCRIPT ---------------->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
    <script>
      AOS.init();
    </script>
<!---------------- HEADER ---------------->
    <div id="header">
      <a class="headerwri"href="../index.php">
        <div data-aos="zoom-in" aos-duration="500" id="animation">
          <b>PluginStore</b>
        </div>
      </a>
    </div>
    <!---------------- FOOTER ---------------->
              <div id="footer">
                  <div id="links_footer">
                    <a class="footer" href="impressum.php">Impressum</a>
                    <a class="footer" href="datenschutz.php">Datenschutz</a>
                    <p class="copyright">© 2020 SilasBeckmann.de</a>
                 </div>
             </div>
<!---------------- NAVBAR ---------------->
    <div id="navbar">
      <div id="links_navbar">
        <a class="navlink" href="spigot.php"><b>SPIGOT</b></a>
        <a class="navlink" href="bungeecord.php"><b>BUNGEECORD</b></a>
        <?php if (!isset($_SESSION['username'])): ?>
        <a class="navlink" href="login/login.php"><b>LOGIN</b></a>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])): ?>
        <a class="navlink" href="login/dashboard.php"><b>ACCOUNT</b></a>
        <?php endif; ?>
      </div>
      <div class="shopping-cart">
        <a class="shopping-btn" href="shoppingcart.php">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </div>
      <div class="search-box">
        <input type="text" name="" class="search-txt" placeholder="Type..."/>
          <a class="search-btn">
            <i class="fas fa-search"></i>
          </a>
        </div>
    </div>

    <!---------------- BUNGEECORD-LIST ---------------->

    <div id="bungeecord">
      <?php
       require("mysql.php");
       $stmt = $mysql->prepare("SELECT * FROM plugins WHERE CATEGORY='bungeecord'");
       $stmt->execute();
       $count = $stmt->rowCount();
       if($count == 0){
           echo "Kein Bungeecord-Plugin vorhanden.";
       } else {
         ?>
            <ul>
         <?php
           while($row = $stmt->fetch()){
               ?>
                   <li>
                     	<form method="post" action="stripe/checkout.php?action=add&id=<?php echo $row["id"]; ?>">
                       <img id="picture" src="upload/<?php echo $row["PICTURE"]?>">
                       <div id="title">
                         <a href="#" name="title"><?php echo $row["TITEL"] ?></a>
                      </div>
                       <p class="status"><?php echo $row["CREATED_BY"] ?></p>
                       <p class="description"><?php echo ($row["DESCRIPTION"]) ?></p>
                       <p class="pricing"><?php echo ($row["PRICING"]) ?>€</p>
                       <p class="category"><?php echo ($row["CATEGORY"]) ?></p>
                       <input type="hidden" name="titel" value="<?php echo $row["TITEL"]; ?>" />
                       <input type="hidden" name="pricing" value="<?php echo $row["PRICING"]; ?>" />
                       <input type="text" name="quantity" class="form-control" value="1" />
                       <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                       <i class="fas fa-shopping-cart"></i>
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
