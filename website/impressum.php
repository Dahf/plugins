<?php
session_start();
 ?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Impressum</title>
    <link href="style/impressum.css" rel="stylesheet">
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
        <a class="shopping-btn" href="checkout.php">
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
    <div id="impressum">
      <h1>Impressum</h1>

<h2>Angaben gem&auml;&szlig; &sect; 5 TMG</h2>
<p>Silas Beckmann<br />
Schwickartsh&auml;user Str. 3<br />
63681 Ranstadt</p>

<h2>Kontakt</h2>
<p>Telefon: +49 1520 6410978<br />
E-Mail: privat@silasbeckmann.de</p>

<h3>Haftung f&uuml;r Inhalte</h3> <p>Als Diensteanbieter sind wir gem&auml;&szlig; &sect; 7 Abs.1 TMG f&uuml;r eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach &sect;&sect; 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, &uuml;bermittelte oder gespeicherte fremde Informationen zu &uuml;berwachen oder nach Umst&auml;nden zu forschen, die auf eine rechtswidrige T&auml;tigkeit hinweisen.</p> <p>Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unber&uuml;hrt. Eine diesbez&uuml;gliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung m&ouml;glich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.</p> <h3>Haftung f&uuml;r Links</h3> <p>Unser Angebot enth&auml;lt Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb k&ouml;nnen wir f&uuml;r diese fremden Inhalte auch keine Gew&auml;hr &uuml;bernehmen. F&uuml;r die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf m&ouml;gliche Rechtsverst&ouml;&szlig;e &uuml;berpr&uuml;ft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar.</p> <p>Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.</p> <h3>Urheberrecht</h3> <p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielf&auml;ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung au&szlig;erhalb der Grenzen des Urheberrechtes bed&uuml;rfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur f&uuml;r den privaten, nicht kommerziellen Gebrauch gestattet.</p> <p>Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.</p>

<p>Quelle: <a href="https://www.e-recht24.de/impressum-generator.html"> www.e-recht24.de</a></p>
    </div>
  </body>
</html>
