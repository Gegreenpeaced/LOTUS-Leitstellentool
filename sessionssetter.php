<?php
session_start();
if ($_SESSION["valid_user"] == false)
{
header("location:index.php");
exit;
}
?>
