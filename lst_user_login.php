<?php
require("downchecker.php");
session_start();
if($_POST['send'] == 1337)
{
  require("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
  $name = $_SESSION['username'];
  $sql = "INSERT INTO `lst_login_fahrt` (`l_user`, `lst_confirm`) VALUES ('$name', '0')";
  $res = mysqli_query($con, $sql);

  if(mysqli_affected_rows($con) > 0)
  {
    header("location:lst_show_user.php?msg=1");
    die;
  }
  else {
    header("location:lst_show_user.php?msg=2");
    die;
  }
}
else {
  header("location:lst_show_user.php?msg=3");
}
mysqli_close($con);
?>
