<?php
// Die Absender E-Mail Adresse
$from = 'Citroen H Fan <hagen@novatrend.ch>';
// Die Emfänger E-Mail Adresse
$sendTo = 'Silas <silasbeckmann1508@gmail.com>';
// E-Mail Betreff
$subject = 'Eine neue Nachricht von einem Citroen H Fan';
// Feldernamen und ihre Übersetzungen
// Ein Array bestehend aus dem Variablennamen => Tect der in der Email erscheint
$fields = array('name' => 'Name', 'email' => 'E-Mail', 'message' => 'Nachricht');
// Nachricht, wenn die E-Mail verschicht wurde
$okMessage = 'Deine Nachricht wurde verschickt. Vielen Dank. Wenn du deine E-Mail angegeben hast, melde ich mich vielleicht bei dir!';
// Nachricht, wenn die E-Mail nicht verschicht wurde
$errorMessage = 'Irgendwas ging schief bei der Übermittlung der Daten. Versuche es einfach später nochmal.';
try{
  if(count($_POST) == 0) throw new \Exception('Formular ist leer');
  $emailText = "Neue Nachricht aus dem Citroen H Formular \n=============================\n";
  foreach ($_POST as $key => $value) {
    // Wenn ein Feld da ist, schreibe es in die E-Mail
    if (isset($fields[$key])) {
      $emailText .= "$fields[$key]: $value\n";
    }
  }
  // E-Mail Header
  $headers = array('Content-Type: text/plain; charset="UTF-8";',
    'From: ' . $from,
    'Reply-To: ' . $from,
    'Return-Path: ' . $from,
    );
  header("Location: ../index.php");
  $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e){
  $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}
