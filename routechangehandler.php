<?php
if($_POST['send'] == 1337)
{

    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
    $sql = "DELETE FROM `lst_routes` WHERE `r_prim` = '" . $_POST['route_prim'] . "'";
    mysqli_query($con, $sql);
    $num = mysqli_affected_rows($con);
    if($num > 0)
    {
      mysqli_close($con);

      $con2 = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
      mysqli_select_db($con2, "$MYSQL_DB"); //Auswahl der Datenbank
      $sql2 = "INSERT INTO `lst_routes` (r_prim, r_nmr, r_map, r_code, r_dl_cat, r_day) VALUES ('" . $_POST['route_prim'] . "', '" . $_POST['route_number'] . "', '" . $_POST['route_map'] . "', '" . $_POST['route_code'] . "','" . $_POST['route_dl_cat'] . "','" . $_POST['day'] . "')";
      mysqli_query($con2, $sql2);
      $num2 = mysqli_affected_rows($con2);
        if ($num2 > 0)
        {
            $map = $_POST['route_map'];
            $nmr = $_POST['route_number'];
            mysqli_close($con2);
            header("location:route.php?msg=6&map=$map&nmr=$nmr");                                 // Erfolgreich!
        }
        else
        {
            $map = $_POST['route_map'];
            $nmr = $_POST['route_number'];
            mysqli_close($con2);
            header("location:route.php?msg=7&map=$map&nmr=$nmr");                                 // fehlgeschlagen MYSQL Fehler!
        }

      }
      else {
        mysqli_close($con);
        header("location:route.php?msg=8");                                           // nur halb funktioniert
      }

}
else {
  header("location:route.php?msg=1");                                           // Formular manipuliert!
}
?>
