<?php
if($_POST['send'] == 1337)
{

  if($_POST['dark'] == on)
  {
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
    mysqli_query($con, "UPDATE sys_user SET darkth = 1 WHERE u_nickname='" . $_POST['username'] . "'");
    $num = mysqli_affected_rows($con);
    if ($num > 0)
    {
      mysqli_close($con);
      $_SESSION['dark'] = array();
      $_SESSION['dark'] = 1;
      header("location:settings.php?msg=1");
    }
    else
    {
      mysqli_close($con);
      $_SESSION['dark'] = array();
      $_SESSION['dark'] = 0;
      header("location:settings.php?msg=2");
    }
  }
  else
  {
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
    mysqli_query($con, "UPDATE sys_user SET darkth = 0 WHERE u_nickname='" . $_POST['username'] . "'");
    $num = mysqli_affected_rows($con);
    if($num > 0)
    {
      mysqli_close($con);
      $_SESSION['dark'] = array();
      $_SESSION['dark'] = 0;
      header("location:settings.php?msg=6");
    }
    else
    {
      mysqli_close($con);
      $_SESSION['dark'] = array();
      $_SESSION['dark'] = 1;
      header("location:settings.php?msg=7");
    }
  }
}
else
{
  header("location:settings.php?msg=5");
}
 ?>
