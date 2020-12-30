<?php
/*
* @author Silas Beckmann
*
* Zu den bestimmten Zahlen wird ein Name zugeordnet
*/
define("USER", 0);
define("MOD", 1);
define("ADMIN", 2);

/*
* @author Silas Beckmann
* @return Gibt den Rank von dem Nutzer $username zurück
*
* Erhalte den Rank des Nutzers
*/
function getRank($username){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
  $stmt->bindParam(":user", $username, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["SERVERRANK"];
}
/*
* @author Silas Beckmann
* @return boolean wird ausgegeben ob der Nutzer $username gebannt ist
*
* Schau ob der Nutzer gebannt ist
*/
function isBanned($username){
  if(getRank($username) == -1){
    return true;
  } else {
    return false;
  }
}

?>
