<?php
require("downchecker.php");
require("mysql_config_notlogin.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql_version = "SELECT `version` FROM `system` WHERE `prim`='1'";
$res_version = mysqli_query($con, $sql_version);
$data = mysqli_fetch_assoc($res_version);
echo "<footer class='sidebar-footer'>LOTUS - Leitstellentool<br>Copyright &copy by Julius Reiter 2020 | Version " . $data['version'] . " | <a href='impressum.php'>Impressum</a></footer>"
?>
