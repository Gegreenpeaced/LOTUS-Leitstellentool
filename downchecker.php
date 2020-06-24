<?php
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "SELECT * FROM `system`";
$data = mysqli_query($con, $sql);
echo $sql;
print_r($data);

if($data['down_mode'] == 1)
{
  header("location:index.php");
}
else {
  echo "<h4>Hallo</h4>";
}
mysqli_close($con);
?>
