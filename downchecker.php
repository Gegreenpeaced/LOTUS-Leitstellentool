<?php
require("mysql_config_notlogin.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "SELECT `down_mode` FROM `system`";
$res = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($res);

if($data['down_mode'] == 1)
{
  header("location:down/index.php");
}
else {
  mysqli_close($con);
}
?>
