<?php
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "DELETE FROM `lst_fahrten` WHERE lst_date='" . $_POST['date'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if ($num > 0)
{
    mysqli_close($con);
    $date = $_POST['date'];
    $name = $_POST['name'];
    header("location:lst_show_admin.php?msg=8&date=$date&name=$name");
    exit;
}
else
{
    mysqli_close($con);
    $name = $_POST['name'];
    $date = $_POST['date'];
    header("location:lst_show_admin.php?msg=9&date=$date&name=$name");
    exit;
}
}
else {
  header("location:lst_show_admin.php?msg=3");
  exit;
}
?>
