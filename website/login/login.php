<?php
session_start();

/*
* @author Philipp Semmel
* @return String mit random characters
*
* Funktion für das erstellen eines zufälligen Tokens
*/

function getRandomString($n) {
  $n=10;
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }

  return $randomString;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <title>Login</title>
  <link href="../style/login.css" rel="stylesheet">
  <link rel="shortcut icon" href="../upload/plug.png">
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
      <a class="footer" href="../impressum.php">Impressum</a>
      <a class="footer" href="../datenschutz.php">Datenschutz</a>
      <a class="footer" href="../kontaktformular.php">Kontaktformular</a>
      <p class="copyright">© 2020 SilasBeckmann.de</a>
      </div>
    </div>
    <!---------------- NAVBAR ---------------->
    <div id="navbar">
      <div id="links_navbar">
        <a class="navlink" href="../spigot.php"><b>SPIGOT</b></a>
        <a class="navlink" href="../bungeecord.php"><b>BUNGEECORD</b></a>
        <?php if (!isset($_SESSION['username'])): ?>
          <a class="navlink" href="login.php"><b>LOGIN</b></a>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])): ?>
          <a class="navlink" href="dashboard.php"><b>ACCOUNT</b></a>
        <?php endif; ?>

      </div>
      <div class="shopping-cart">
        <a class="shopping-btn" href="../stripe/checkout.php">
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

    <!---------------- LOGIN/REGISTER ---------------->

    <div id="login">
      <div class="login-picture">
        <i class="fas fa-sign-in-alt fa-3x"></i>
      </div>
      <h1>ANMELDEN</h1>
      <form action="login.php" method="post">
        <input type="text" name="username_login" placeholder="Username" required class="typein"><br>
        <input type="password" name="pw_login" placeholder="Passwort" required class="typein"><br>
        <button type="submit" name="submit_login" class="loggin-btn">Einloggen</button>
      </form>
    </div>
    <div id="register">
      <div class="register-picture">
        <i class="fas fa-user-plus fa-3x"></i>
      </div>
      <h1 class="h1-register">KUNDENKONTO ANLEGEN</h1>
      <form action="login.php" method="post">
        <input type="text" name="username_register" placeholder="Username" required class="typein"><br>
        <input type="text" name="email_register" placeholder="Email" required class="typein"><br>
        <input type="password" name="pw_register" placeholder="Passwort" required class="typein"><br>
        <input type="password" name="pw_register2" placeholder="Passwort wiederholen" required class="typein"><br>
        <button type="submit" name="submit_register" class="loggin-btn">Erstellen</button>
      </form>
    </div>
    <div id="register">
      <?php
      if(isset($_POST["submit_register"])){
        require("../mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");// Username überprüfen
        $stmt->bindParam(":user", $_POST["username_register"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){                                                        // Username ist frei
          $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email");// Email überprüfen
          $stmt->bindParam(":email", $_POST["email_register"]);
          $stmt->execute();
          $count = $stmt->rowCount();
          if($count == 0){
            if($_POST["pw_register"] == $_POST["pw_register2"]){                // Passwörter stimmen übereinander ein
              $stmt = $mysql->prepare("INSERT INTO accounts (id, USERNAME, PASSWORD, EMAIL, SERVERRANK, MINECRAFT, TOKEN) VALUES (0, :user, :pw, :email, 0, null, :token)");
              $stmt->bindParam(":token", getRandomString($n), PDO::PARAM_STR);
              $stmt->bindParam(":user", $_POST["username_register"]);
              $hash = password_hash($_POST["pw_register"], PASSWORD_BCRYPT);
              $stmt->bindParam(":pw", $hash);
              $stmt->bindParam(":email", $_POST["email_register"]);
              $stmt->execute();                                                 // Nutzer mit den Daten wird erstellt
              echo '<p id="commentaryregister"> Kundenkonto angelegt</p>';
              ?>
              <script>
              setTimeout(function(){document.getElementById('commentaryregister').remove();},10000); // Element wird nach 10000 Millisekunden gelöscht
              </script>
              <?php
            } else {
              echo '<p id="commentaryregister">Passwörter stimmen nicht übereinander ein</p>';
              ?>
              <script>
              setTimeout(function(){document.getElementById('commentaryregister').remove();},10000);
              </script>
              <?php
            }
          } else {
            echo '<p id="commentaryregister">E-Mail bereits vergeben</p>';
            ?>
            <script>
            setTimeout(function(){document.getElementById('commentaryregister').remove();},10000);
            </script>
            <?php
          }
        } else {
          echo '<p id="commentaryregister">Username bereits vergeben </p>';
          ?>
          <script>
          setTimeout(function(){document.getElementById('commentaryregister').remove();},10000);
          </script>
          <?php
        }
      }
      ?>
    </div>
    <div id="login">
      <?php
      if(isset($_POST["submit_login"])){
        require("../mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); // Username überprüfen
        $stmt->bindParam(":user", $_POST["username_login"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){                                                        // Username existiert

          $row = $stmt->fetch();
          if(password_verify($_POST["pw_login"], $row["PASSWORD"])){
            $_SESSION["username"] = $row["USERNAME"];
            header("Location: dashboard.php");
          } else {
            echo '<p id="commentarylogin"> Login fehlgeschlagen</p>';
            ?>
            <script>
            setTimeout(function(){document.getElementById('commentarylogin').remove();},10000);
            </script>
            <?php
          }
        } else {
          echo '<p id="commentarylogin"> Login fehlgeschlagen</p>';
          ?>
          <script type="text/javascript">
          setTimeout(function(){document.getElementById('commentarylogin').remove();},10000);
          </script>
          <?php
        }
      }
      ?>
    </div>
  </body>
  </html>
