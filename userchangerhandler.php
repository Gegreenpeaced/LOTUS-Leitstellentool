<?php
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "UPDATE sys_user SET u_rechte = '" . $_POST['rechte'] . "' WHERE u_mail='" . $_POST['mail'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if ($num > 0)
{
    mysqli_close($con);
    if($_POST['rechte'] == 1)
    {
    $rechte = "Nutzer";
    }
    if($_POST['rechte'] == 2)
    {
    $rechte = "Moderator";
    }
    if($_POST['rechte'] == 3)
    {
    $rechte = "Admin";
    }
    header("location:usershow_admin.php?msg=4&rechte=$rechte");
    exit;
}
else
{
    mysqli_close($con);
    header("location:usershow_admin.php?msg=5");
    exit;
}
}
else {
  header("location:usershow_admin.php?msg=3");
  exit;
}
?>
