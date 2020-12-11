<?php
session_start();
 ?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Kontaktformular</title>
    <link rel="stylesheet" href="style/kontaktformular.css">
  </head>
  <body>
    <div id="contact">
      <form>
      <input name="name" type="text" class="feedback-input" placeholder="Name"/>
      <input name="email" type="text" class="feedback-input" placeholder="email" />
      <textarea name="text" class="feedback-input" placeholder="Nachricht" rows="20"></textarea>
      <input type="submit" value="Senden"/>
    </form>
    </div>
  </body>
</html>
