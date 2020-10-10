<?php
require("downchecker.php"); ?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/login.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='shortcut icon' href='img/favicon.png'>
    <title>Registrieren | LOTUS-Leitstelle</title>
  </head>
  <body>
    <div class="login">
    <form class="login" action="registerhandler.php" method="post">
      <h1>Registrieren</h1>
      <?php
      if($_GET['change'] == 2)
      {
        echo "<h4>Registrierung nicht möglich!</h4>"; //Nutzer konnte nicht eingetragen werden!
      }
      if($_GET['change'] == 3)
      {
        echo "<h4>Registrierung nicht möglich!</h4>"; //Token konnte nicht auf BENUTZT gesetzt werden!
      }
      if($_GET['change'] == 4)
      {
        echo "<h4>Token nicht gefunden!</h4>"; //Token nicht in der Datenbank existent!
      }
      if($_GET['change'] == 5)
      {
        echo "<h4>Passwörter stimmen nicht überein!</h4>"; // Beide Passwort eingaben waren nicht gleich!
      }
      ?>
      <input type="text" name="vorname" maxlength="20" placeholder="Vorname (max. 20 Zeichen)" required></input>
      <input type="text" name="nachname" maxlength="20" placeholder="Nachname (max. 20 Zeichen)" required></input>
      <input type="text" name="username" maxlength="20" placeholder="Username (max. 20 Zeichen)" required></input>
      <input type="email" name="mail" maxlength="50" placeholder="E-Mail" required></input>
      <input type="password" name="password" maxlength="255" placeholder="Password" required></input>
      <input type="password" name="password_2" maxlength="255" placeholder="Password wiederholen" required></input>
      <input type="number" name="token" maxlength="15" placeholder="Token" required></input>
      <input type="submit" name="" value="Registrieren"></input>
      <div class="login-a">
      <a class="login-a-class" href="login.php">Anmelden</a> oder <a class="login-a-class" href="reset.php">Passwort zurücksetzen</a>
      </div>
    </form>
    </div>
  </body>
</html>
