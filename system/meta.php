<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<?php
require("mysql_config.php");
$con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
session_sart();
print_r($_SESSION);
$sql = "SELECT `themeurl` FROM `sys_user` WHERE `u_nickname`='Gegreenpeaced'";
echo $sql;
?>
<link rel="stylesheet" href="../src/css/styles/normal.css">
<link rel='shortcut icon' href='../src/img/favicon.png'>
