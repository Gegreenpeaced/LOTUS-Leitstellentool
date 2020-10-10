<?php
require("downchecker.php");
session_start();
if($_POST['send'] == 1337)
{
  require("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
  $name = $_SESSION['username'];
  $sql = "DELETE FROM `lst_login_fahrt` WHERE `l_user` = '" . $_SESSION['username'] . "'";
  $res = mysqli_query($con, $sql);

  if(mysqli_affected_rows($con) > 0)
  {
    mysqli_close($con);
    header("location:lst_show_user.php?msg=4");
    die;
  }
  else {
    mysqli_close($con);
    header("location:lst_show_user.php?msg=5");
    die;
  }
}
else {
  header("location:lst_show_user.php?msg=3");
}
?>
