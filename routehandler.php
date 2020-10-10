<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{

        include("mysql_config.php");
        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
        $prim = uniqid();
        $sql = "INSERT INTO `lst_routes` (r_prim, r_nmr, r_map, r_code, r_dl_cat, r_dest_one, r_dest_two, r_day) VALUES ('" . $prim . "', '" . $_POST['route_number'] . "', '" . $_POST['route_map'] . "', '" . $_POST['route_code'] . "', '" . $_POST['route_dl_cat'] . "','" . $_POST['dest_one'] . "','" . $_POST['dest_two'] . "','" . $_POST['day'] . "')";
        mysqli_query($con, $sql);
        $num = mysqli_affected_rows($con);

        if ($num > 0)
        {

            $date_db = date('D d M Y, h:i');
            $sql_dl = "INSERT INTO `dl_center` (prim, name, link, cat, date_t, des) VALUES ('$prim', '" . $_POST['route_code'] . "', '" . $_POST['route_card'] . "', '" . $_POST['route_dl_cat'] . "', '$date_db', '" . $_POST['dest_one'] . " - " . $_POST['dest_two'] . "')";
            mysqli_query($con, $sql_dl);

            $num_dl = mysqli_affected_rows($con);

            if($num_dl > 0)
            {
              $map = $_POST['route_map'];
              $nmr = $_POST['route_number'];
              header("location:route.php?msg=2&map=$map&nmr=$nmr");                                 // Erfolgreich!
            }
            else {
              header("location.route.php?msg=");
            }
        }
        else
        {
            $map = $_POST['route_map'];
            $nmr = $_POST['route_number'];
            header("location:route.php?msg=3&map=$map&nmr=$nmr");                                 // Move fehlgeschlagen oder MYSQL Fehler!
        }

        mysqli_close($con);


}
else {
  header("location:route.php?msg=1");                                           // Formular manipuliert!
}
?>
