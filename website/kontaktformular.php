<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Kontaktformular</title>
    <link rel="stylesheet" href="style/kontaktformular.css">
    <link rel="shortcut icon" href="upload/plug.png">
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
      <a class="headerwri"href="index.php">
        <div data-aos="zoom-in" aos-duration="500" id="animation">
          <b>PluginStore</b>
        </div>
      </a>
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
        <a class="shopping-btn" href="stripe/checkout.php">
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
    <!---------------- FOOTER ---------------->
    <div id="footer">
      <div id="links_footer">
        <a class="footer" href="impressum.php">Impressum</a>
        <a class="footer" href="datenschutz.php">Datenschutz</a>
        <a class="footer" href="kontaktformular.php">Kontaktformular</a>
        <p class="copyright">© 2020 SilasBeckmann.de</a>
      </div>
    </div>
    <!---------------- CONTACT ---------------->
    <div id="contact">
      <form>
        <input name="name" type="text" class="feedback-input" placeholder="Name"/>
        <input name="email" type="text" class="feedback-input" placeholder="email" />
        <textarea name="text" class="feedback-input" placeholder="Nachricht" rows="20"></textarea>
        <input type="submit" value="Senden"/>
      </form>
    </div>
  </body>
</html>
