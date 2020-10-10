<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "DELETE FROM `lst_fahrzeuge` WHERE f_nmr='" . $_POST['old_nmr'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
    if ($num > 0)                          // Erste Schleife wenn richtig gelöscht wurde
    {
      mysqli_close($con);
      $con2 = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
      mysqli_select_db($con2, "$MYSQL_DB"); //Auswahl der Datenbank
      $sql2 = "INSERT INTO `lst_fahrzeuge` (f_nmr, f_class, f_typ, f_stufen, f_zr, f_trak, f_platz, f_gauge) VALUES ('" . $_POST['vehicle_number'] . "','" . $_POST['vehicle_class'] . "','" . $_POST['vehicle_typ'] . "','" . $_POST['vehicle_stairs'] . "','" . $_POST['vehicle_twoway'] . "',
      '" . $_POST['vehicle_traction'] . "','" . $_POST['vehicle_platz'] . "','" . $_POST['vehicle_gauge'] . "')";
      mysqli_query($con2, $sql2);
      $num = mysqli_affected_rows($con2);
      if ($num > 0)
      {
        $nmr = $_POST['vehicle_number'];
        header("location:fahrzeuge.php?msg=6&nmr=$nmr");                          // Erste Schleife wenn richtig eingesetzt wurde
        mysqli_close($con2);
      }
      else
      {
        $nmr = $_POST['vehicle_number'];
        header("location:fahrzeuge.php?msg=8&nmr=$nmr");                          // Erste Schleife wenn NICHT richtig eingesetzt wurde
        mysqli_close($con2);
      }
    }
    else
    {
      $nmr = $_POST['vehicle_number'];
      header("location:fahrzeuge.php?msg=7&nmr=$nmr");                            // WENN NICHT GELÖSCHT WERDEN KONNTE
      mysqli_close($con2);
    }
}

else
  {
    header("location:fahrzeuge.php?msg=3");                                       //FORMULAR MANIPULATION
    exit;
  }
?>
