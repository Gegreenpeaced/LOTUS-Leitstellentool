<?php
if($_POST['type'] == 1)                                               // Tokens generieren!
  {
    if($_POST['send'] == 1337)
    {
      include("mysql_config.php");
      $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
      mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank

      $res = mysqli_query($con, "SELECT * FROM `sys_token`"); //Auswahl der Tabelle
      $ran = rand(100000000000000, 999999999999999);
      $sql = "INSERT INTO `sys_token`(l_token, used) VALUES ('$ran','0')";
      mysqli_query($con, $sql);
      $num = mysqli_affected_rows($con);
      if ($num > 0)
        {
            header("location:system.php?msg=1&token=$ran");
        }
        else
        {
            header("location:system.php?msg=2");
        }

        mysqli_close($con);
    }
    else {
        header("location:system.php?msg=3");
      }
  }

if($_POST['type'] == 2)                                                 // Fahrzeug Typen
{
  if($_POST['send'] == 1337)
  {
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
    $sql = "INSERT INTO `sys_vehicle` (`name`) VALUES ('" . $_POST['text_type'] . "')";
    mysqli_query($con, $sql);
    $num = mysqli_affected_rows($con);
    if($num > 0)
    {
      $type = $_POST['text_type'];
      header("location:system.php?msg=6&type=$type");
    }
    else {
      header("location:system.php?msg=7");
    }
  }

  else {
    header("location:system.php?msg=5");
  }
}

if($_POST['type'] == 3)                                                 // Fahrzeug Typen
{
  if($_POST['send'] == 1337)
  {
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
    $sql = "INSERT INTO `sys_dl_cat` (`name`, `name_drop_menu`, `name_table`, `des_table`) VALUES ('" . $_POST['cat_text'] . "', '" . $_POST['cat_drop'] . "', '" . $_POST['cat_table'] . "', '" . $_POST['cat_des'] . "')";
    mysqli_query($con, $sql);
    $num = mysqli_affected_rows($con);
    if($num > 0)
    {
      $type = $_POST['text_type'];
      header("location:system.php?msg=8&type=$type");
    }
    else {
      header("location:system.php?msg=9");
    }
  }
}
else {
  header("location:system.php?msg=10");
}
?>
