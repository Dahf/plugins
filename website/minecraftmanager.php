<?php
function getMinecraft($mc){
    require("mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :name"); //Erstellt den Account mit den Information die man ausgefüllt hat
    $stmt->execute(array(":name" => $mc));
    $row = $stmt->fetch();
    return $row["MINECRAFT"];
}
?>
