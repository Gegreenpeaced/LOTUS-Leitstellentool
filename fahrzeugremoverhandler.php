<?php
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "DELETE FROM `lst_fahrzeuge` WHERE f_nmr='" . $_POST['vehicle_remove'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if ($num > 0)
{
    mysqli_close($con);
    $nmr = $_POST['vehicle_remove'];
    header("location:fahrzeuge.php?msg=1&nmr=$nmr");
    exit;
}
else
{
    mysqli_close($con);
    $nmr = $_POST['vehicle_remove'];
    header("location:fahrzeuge.php?msg=2&nmr=$nmr");
    exit;
}
}
else {
  header("location:fahrzeuge.php?msg=3");
  exit;
}
?>
