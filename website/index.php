<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>PluginStore</title>
    <link href="style/main.css" rel="stylesheet">
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
    <!---------------- VIDEO ---------------->
    <video autoplay muted loop id="backgroundVideo">
      <source src="cinematic/cinematic.mp4" type="video/mp4">
    </video>
    <!---------------- MAINBODY ---------------->
    <div class="mainbody">
      <iframe name="mainframe" id="mainframe" src="news.php"></iframe>
    </div>
  </body>
</html>
