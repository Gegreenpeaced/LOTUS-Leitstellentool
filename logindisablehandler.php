<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
  include("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
  $sql_date_save = "UPDATE `system` SET `lst_next_date`='N/A' WHERE `prim`='1'";
  mysqli_query($con, $sql_date_save);
  $sql = "UPDATE `lst_fahrten` SET lst_login_pb = '0' WHERE `lst_date`='" . $_POST['date'] . "'";
  mysqli_query($con, $sql);
  $num = mysqli_affected_rows($con);
  if($num > 0)
  {
    $sql2 = "DELETE FROM `lst_user_login` WHERE '1'";
    mysqli_query($con, $sql2);
    mysqli_close($con);
    header("location:lst_show_admin.php?msg=6");
  }
  else {
    mysqli_close($con);
    header("location:lst_show_admin.php?msg=7");
  }
}
else {
  header("location:lst_show_admin.php?msg=3");
}
?>
