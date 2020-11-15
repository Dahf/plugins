<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Login</title>
    <link href="../style/login.css" rel="stylesheet">
  </head>
  <body>
<!--login-->
    <?php
    if(isset($_POST["submit_login"])){
      require("../mysql.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username_login"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 1){
        //Username ist frei
        $row = $stmt->fetch();
        if(password_verify($_POST["pw_login"], $row["PASSWORD"])){
          session_start();
          $_SESSION["username"] = $row["USERNAME"];
          header("Location: dashboard.php");
        } else {
          echo "Der Login ist fehlgeschlagen";
        }
      } else {
        echo "Der Login ist fehlgeschlagen";
      }
    }
     ?>
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
<!---------------- LOGIN ---------------->
<div id="login">
  <h1>Anmelden</h1>
  <form action="login.php" method="post">
    <input type="text" name="username_login" placeholder="Username" required class="typein"><br>
    <input type="password" name="pw_login" placeholder="Passwort" required class="typein"><br>
    <button type="submit" name="submit_login" class="login-btn">Einloggen</button>
  </form>
  <br>
</div>
<!--register-->
<?php
if(isset($_POST["submit_register"])){
  require("../mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
  $stmt->bindParam(":user", $_POST["username_register"]);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count == 0){
    //Username ist frei
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //Username überprüfen
    $stmt->bindParam(":email", $_POST["email_register"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      if($_POST["pw_register"] == $_POST["pw_register2"]){
        //User anlegen
        $stmt = $mysql->prepare("INSERT INTO accounts (id, USERNAME, PASSWORD, EMAIL, TOKEN, SERVERRANK) VALUES (0, :user, :pw, :email, null, 0)");
        $stmt->bindParam(":user", $_POST["username_register"]);
        $hash = password_hash($_POST["pw_register"], PASSWORD_BCRYPT);
        $stmt->bindParam(":pw", $hash);
        $stmt->bindParam(":email", $_POST["email_register"]);
        $stmt->execute();
        echo "Dein Account wurde angelegt";
      } else {
        echo "Die Passwörter stimmen nicht überein";
      }
    } else {
      echo "Email bereits vergeben";
    }
  } else {
    echo "Der Username ist bereits vergeben";
  }
}
 ?>
<div id="register">
  <h1>Account erstellen</h1>
  <form action="login.php" method="post">
    <input type="text" name="username_register" placeholder="Username" required class="typein"><br>
    <input type="text" name="email_register" placeholder="Email" required class="typein"><br>
    <input type="password" name="pw_register" placeholder="Passwort" required class="typein"><br>
    <input type="password" name="pw_register2" placeholder="Passwort wiederholen" required class="typein"><br>
    <button type="submit" name="submit_register" class="login-in">Erstellen</button>
  </form>
  <br>
</div>
  </body>
</html>
