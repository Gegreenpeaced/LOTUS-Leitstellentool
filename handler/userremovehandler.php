<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "DELETE FROM `sys_user` WHERE u_mail='" . $_POST['r_mail'] . "' and u_nickname ='" . $_POST['r_nickname'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if ($num > 0)
{
    mysqli_close($con);
    $mail = $_POST['r_mail'];
    $nickname = $_POST['r_nickname'];
    header("location:usershow_admin.php?msg=1&name=$nickname&mail=$mail");
    exit;
}
else
{
    mysqli_close($con);
    $mail = $_POST['r_mail'];
    $nickname = $_POST['r_nickname'];
    header("location:usershow_admin.php?msg=2&name=$nickname&mail=$mail");
    exit;
}
}
else {
  header("location:usershow_admin.php?msg=3");
  exit;
}
?>
