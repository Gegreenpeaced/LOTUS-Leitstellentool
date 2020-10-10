<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
  include("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
  $pass1234 = password_hash("123456", PASSWORD_DEFAULT);
  $sql = "UPDATE `sys_user` SET  u_pass = '$pass1234' WHERE `u_mail`='" . $_POST['r_mail'] . "' AND `u_nickname` = '". $_POST['r_nickname'] . "'";
  mysqli_query($con, $sql);
  $num = mysqli_affected_rows($con);
  if($num > 0)
  {
    mysqli_close($con);
    header("location:usershow_admin.php?msg=6");
  }
  else {
    mysqli_close($con);
    header("location:usershow_admin.php?msg=7");
  }
}
else {
  header("location:usershow_admin.php?msg=3");
}
?>
