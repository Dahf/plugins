<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Kontaktformular</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style/kontaktformular.css">
  </head>
  <body>
    <div class="row">
      <div class="col-1 col-sm-1 col-md-2 col-lg-2 col-xl-2"></div>
      <div class="col-10 col-sm-10 col-md-8 col-lg-8 col-xl-8">
      <form id="contact-form" method="post" action="kontaktformular/contact.php" role="form">
      <p class="lead">Kontaktformular</p>
      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" name="name" type="text" id="name" placeholder="Canice Jaime Oestreich" required>
      </div>
      <div class="form-group">
        <label for="email">E-Mail Adresse (optional)</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="canice@oestreich.com" required>
       </div>
       <div class="form-group">
         <label for="message">Nachricht</label>
         <textarea class="form-control" name="message" id="message" rows="3" placeholder="Der Prinz von Östreich" required></textarea>
       </div>
       <button type="submit" class="btn btn-primary">Senden</button>
       </form>
    </div>
    <div class="col-1 col-sm-1 col-md-2 col-lg-2 col-xl-2"></div>
    </div>
  </body>
</html>
