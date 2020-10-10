<?php
  session_start();
  require("mysql_config.php");
  $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
  mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
  mysqli_query($con, "UPDATE `sys_user` SET `status`='0' WHERE `u_mail`='" . $_SESSION['mail'] . "' OR u_nickname='" . $_SESSION['username'] . "'");
  $_SESSION = array();
  header("location:index.php");
?>
