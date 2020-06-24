<?php
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "DELETE FROM `lst_maps` WHERE `m_name`='" . $_POST['map_name_del'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if ($num > 0)
{
    $mname = $_POST['map_name_del'];
    header("location:maps.php?change=4&map=$mname");
}
else
{
    $mname = $_POST['map_name_del'];
    header("location:maps.php?change=5&map=$mname");
}

mysqli_close($con);
}
else {
  header("location:maps.php?change=3");
}
?>
