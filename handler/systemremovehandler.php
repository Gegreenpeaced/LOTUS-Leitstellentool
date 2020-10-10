<?php
require("downchecker.php");
  include("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank

  if($_POST['type'] == 1)
  {
  if($_POST['send'] == 1337)
  {
  $token = $_POST['token'];
  $sql = "DELETE FROM `sys_token` WHERE l_token = '$token'";
  mysqli_query($con, $sql);
  $num = mysqli_affected_rows($con);
    if ($num > 0)
      {
        header("location:system.php?msg=3&token=$token");
      }
    else
      {
        header("location:system.php?msg=4&token=$token");
      }
  mysqli_close($con);
  }
  else {
    header("location:system.php?msg=5");
  }
  }

  if($_POST['type'] == 2)
  {
  if($_POST['send'] == 1337)
  {
  $type = $_POST['vehicle'];
  $sql = "DELETE FROM `sys_vehicle` WHERE `name` = '$type'";
  mysqli_query($con, $sql);
  $num = mysqli_affected_rows($con);
    if ($num > 0)
      {
        $sql_r_data = "DELETE FROM `lst_fahrzeuge` WHERE `f_typ` = '$type'";
        mysqli_query($con, $sql_r_data);
        $num_r_data = mysqli_affected_rows($con);
        if($num_r_data > 0)
        {
            header("location:system.php?msg=8&type=$type");
        }
        else {
            header("location:system.php?msg=13&type=$type");
        }
      }
    else
      {
        header("location:system.php?msg=9&type=$type");
      }
  mysqli_close($con);
  }
  else {
    header("location:system.php?msg=5");
    }
  }

  if($_POST['type'] == 3)
  {
    if($_POST['send'] == 1337)
    {
      $cat = $_POST['cat'];
      $sql = "DELETE FROM `sys_dl_cat` WHERE `name` = '$cat'";
      mysqli_query($con, $sql);
      $num = mysqli_affected_rows($con);
        if($num > 0)
        {
          $sql_r_data = "DELETE FROM `lst_routes` WHERE `r_dl_cat` = '$cat'";
          mysqli_query($con, $sql_r_data);
          $num_r_data = mysqli_affected_rows($con);
          if($num_r_data > 0)
          {
              header("location:system.php?msg=11&cat=$cat");
          }
          else {
              header("location:system.php?msg=14");
          }
        }
        else {
          header("location:system.php?msg=12");
        }
        mysqli_close($con);
    }
    else {
      header("location:system.php?msg=5");
    }
  }

  if($_POST['type'] == 4)
  {
    if($_POST['send'] == 1337)
    {
      $prim = $_POST['id'];
      $sql = "DELETE FROM `sys_dest` WHERE `prim` = '$prim'";
      mysqli_query($con, $sql);
      $num = mysqli_affected_rows($con);
        if($num > 0)
        {
            $id = $prim;
            header("location:system.php?msg=19&id=$id");
        }
        else {
          echo $sql;
          header("location:system.php?msg=20");
        }
        mysqli_close($con);
    }
    else {
      header("location:system.php?msg=5");
    }
  }
?>
