<?php
// Die Absender E-Mail Adresse
$from = 'Nutzer <test@gmail.com>';
// Die Emfänger E-Mail Adresse
$sendTo = 'Silas Beckmann <silasbeckmann1508@gmail.com>';
$subject = 'Kontaktformular';
$fields = array('name' => 'Name', 'email' => 'E-Mail', 'message' => 'Nachricht');
$okMessage = 'Deine Nachricht wurde verschickt. Vielen Dank.';
$errorMessage = 'Irgendwas ging schief bei der Übermittlung der Daten. Versuche es einfach später nochmal.';
try{
  if(count($_POST) == 0) throw new \Exception('Formular ist leer');
  $emailText = "Neue Nachricht \n__________________________\n";
  foreach ($_POST as $key => $value) {
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
  //email -> SMTP Server aufsetzen
  $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e){
  $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}
