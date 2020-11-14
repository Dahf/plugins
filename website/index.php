<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>PluginStore</title>
    <link href="style/main.css" rel="stylesheet">
  </head>
  <body>
  <!---------------- JAVASCRIPT ---------------->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script>
     AOS.init();
    </script>
  <!---------------- VIDEO ---------------->
      <video autoplay muted loop id="backgroundVideo">
        <source src="cinematic/cinematic.mp4" type="video/mp4">
      </video>
 <!---------------- HEADER ---------------->
      <div id="header">
         <a class="headerwri"href="news.php" target="mainframe">
            <div data-aos="zoom-in" aos-duration="500" id="animation">
                <b>PluginStore</b>
            </div>
         </a>
      </div>
 <!---------------- FOOTER ---------------->
      <div id="footer">
          <a class="footer" href="impressum.html"><b>Impressum</b></a>
      </div>
 <!---------------- NAVBAR ---------------->
         <div id="navbar">
              <div id="links">
                  <a class="navlink" href="spigot.html"><b>SPIGOT</b></a>
                  <a class="navlink" href="bungeecord.html"><b>BUNGEECORD</b></a>
                  <?php if (!isset($_SESSION['username'])): ?>
                  <a class="navlink" href="login/login.php"><b>LOGIN</b></a>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['username'])): ?>
                  <a class="navlink" href="login/dashboard.php"><b>ACCOUNT</b></a>
                  <?php endif; ?>
                </div>
          </div>
 <!---------------- MAINBODY ---------------->
        <div class="mainbody">
           <iframe name="mainframe" id="mainframe" src="news.php"></iframe>
        </div>
  </body>
</html>
