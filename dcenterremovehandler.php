<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "DELETE FROM `dl_center` WHERE prim='" . $_POST['remove_name'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if ($num > 0)
{
    mysqli_close($con);
    $id = $_POST['remove_name'];
    header("location:d_center_admin.php?msg=4&id=$id");
}
else
{
    mysqli_close($con);
    $id = $_POST['remove_name'];
    header("location:d_center_admin.php?msg=5&id=$id");
}
}
else {
  header("location:d_center_admin.php?msg=3");
}
mysqli_close($con);
?>
