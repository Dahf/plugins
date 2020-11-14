<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit;
}
require("../rankmanager.php");
if(isBanned($_SESSION["username"])){
  header("Location: logout.php");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="../style/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  </head>
  <body>
    <!---------------- JAVASCRIPT ---------------->
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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
        <!---------------- NAVBAR ---------------->
                <div id="navbar">
                     <div id="links">
                         <a class="navlink" href="spigot.html"><b>SPIGOT</b></a>
                         <a class="navlink" href="bungeecord.html"><b>BUNGEECORD</b></a>
                         <?php if (!isset($_SESSION['username'])): ?>
                         <a class="navlink" href="login.php"><b>LOGIN</b></a>
                         <?php endif; ?>
                         <?php if (isset($_SESSION['username'])): ?>
                         <a class="navlink" href="dashboard.php"><b>ACCOUNT</b></a>
                         <?php endif; ?>
                       </div>
                 </div>

    <div class="buttonlist">
    <ul>
    <li><a href="../plugins/addplugins.php" class="button" target="mainframe">PLUGINS</a></li>
    <li><a href="../benutzer/benutzer.php" class="button" target="mainframe">BENUTZER</a></li>
    <li><a href="logout.php" class="button">ABMELDEN</a></li>
  </ul>
  </div>
  </div>

  <div class="mainbody">
     <iframe name="mainframe" id="mainframe" src="uebersicht.php"></iframe>
  </div>

  </body>
</html>
