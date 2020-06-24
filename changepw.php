<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/login.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='shortcut icon' href='src/pic/favicon.png'>
    <title>Passwort ändern | LOTUS - Leitstelle</title>
  </head>
  <body>
    <div class="login">
    <form class="login" action="changepwhandler.php" method="post">
      <h1>Passwort ändern</h1>
      <?php
      if($_GET['msg'] == 1)
      {
        echo "<h4>Altes Passwort ist falsch!</h4>";
      }
      if($_GET['msg'] == 2)
      {
        echo "<h4>Kein Nutzer in der Datenbank gefunden [ERROR:01]</h4>";
      }
      if($_GET['msg'] == 3)
      {
        echo "<h4>Die Neuen Passwörter stimmen nicht überein</h4>";
      }
      ?>
      <?php
      echo "<input type='password' name='password_old' placeholder='Altes Passwort'required></input>";
      echo "<input type='password' name='password_new' placeholder='Neues Passwort'required></input>";
      echo "<input type='password' name='password_new_2' placeholder='Neues Passwort wiederholen'required></input>";
      echo "<input type='submit' value='Passwort ändern'></input>";
      ?>
    </div>
    </form>
  </body>
</html>
