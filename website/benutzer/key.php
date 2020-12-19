<?php
session_start();
require("../rankmanager.php"); //Rankmanager importiert
if(isBanned($_SESSION["username"])){
  header("Location: ../login/logout.php"); //Falls er gebannt ist wird er ausgeloggt
  exit;
}
?>
