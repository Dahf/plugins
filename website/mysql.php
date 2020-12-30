<?php
/**
* @author Silas Beckmann
*
* Connection zur Datenbank
*/

$host = "localhost";
$name = "test";
$user = "root";
$passwort = "";
try{
  $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
  echo "SQL Error: ".$e->getMessage();
}
?>
