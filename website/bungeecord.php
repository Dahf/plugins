<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Bungeecord</title>                                   <!--immer abändern-->
    <link href="style/bungeecord.css" rel="stylesheet">  <!--immer abändern-->
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
        <a class="footer" href="impressum.html" target="_blank"><b>Impressum</b></a>
        <a class="footer" href="agb.html" target="_blank"><b>AGB</b></a>
        <a class="footer" href="datenschutz.html" target="_blank"><b>Datenschutz</b></a>
        <a class="footer" href="cookie-informationen.html" target="_blank"><b>Cookie Informationen</b></a>
        <a class="footer" href="disclaimer.html" target="_blank"><b>Disclaimer</b></a>
        <a class="footer" href="Kontakt.html" target="_blank"><b>Kontakt</b></a>
        <a class="copyright"><b>© 2020 *auftraggeber</b></a>
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
  </body>
</html>
