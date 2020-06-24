<?php
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$rprim = $_POST['route_prim'];
$sql = "DELETE FROM `lst_routes` WHERE r_prim = '$rprim'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if ($num > 0)
{
    header("location:route.php?msg=4&id=$rprim");
    mysqli_close($con);
}
else
{
    header("location:token.php?msg=5&id=$rprim");
    mysqli_close($con);
}
}
else
{
  header("location:route.php?change=3");
}
?>
