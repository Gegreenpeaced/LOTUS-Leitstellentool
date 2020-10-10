<?php
require("downchecker.php");
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>Login | LOTUS-Leitstelle</title>
    <link rel="stylesheet" href="../src/css/login.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='shortcut icon' href='../src/img/favicon.png'>
  </head>
  <body>
    <div class="login">
    <form class="login" action="../handler/loginhandler.php" method="post">
      <h1>Login</h1>
      <?php
      if($_GET['msg'] == 1)
      {
        echo "<h4>Passwort wurde erfolgreich geändert!</h4>";
      }
      if($_GET['msg'] == 2)
      {
        echo "<h4>Passwort wurde nicht geändert!</h4>";
      }
      if($_GET['error'] == 1)
      {
        echo "<h4>Nutzer nicht gefunden!</h4>";
      }
      if($_GET['error'] == 2)
      {
        echo "<h4>Passwort falsch!</h4>";
      }
      if($_GET['change'] == 1)
      {
        echo "<h4>Erfolgreich registriert!</h4>";
      }
      if($_GET['error'] > 3)
      {
        echo "<h4>Unbekannter Fehler!</h4>";
      }
      ?>
      <input type="text" name="identifier" placeholder="Email or Username" required></input>
      <input type="password" name="password" placeholder="Password" required></input>
      <input type="hidden" name="send" value="1337"></input>
      <input type="submit" name="" value="Login"></input>
    <div class="login-a">
    <a class="login-a-class" href="register.php">Registrieren</a> oder <a class="login-a-class" href="reset.php">Passwort zurücksetzen</a>
    </div>
    </form>
  </div>
  </body>
</html>
