<?php
  $pdo = new PDO('mysql:host=localhost;dbname=irc', 'lotus', 'test123');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
