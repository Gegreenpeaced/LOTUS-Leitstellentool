<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank

    $res = mysqli_query($con, "SELECT * FROM `lst_fahrten`"); //Auswahl der Tabelle
    $sql = "INSERT INTO `lst_fahrten`(lst_name, lst_date, lst_map, lst_admin, lst_fahrzeuge, lst_login_pb, lst_u_login, lst_visible)
    VALUES
    ('" . $_POST['lst_create_name'] . "','" . $_POST['lst_create_date'] . "','" . $_POST['lst_create_map'] . "','" . $_POST['lst_create_leader'] . "','" . $_POST['lst_create_vehicles'] . "', '" . $_POST['lst_login_pb'] . "', '0', '1')";
    mysqli_query($con, $sql);
    $date = $_POST['lst_create_date'];
    $name = $_POST['lst_create_name'];
    $num = mysqli_affected_rows($con);
    if ($num > 0)
        {
            header("location:lst_show_admin.php?msg=1&name=$name&date=$date");
        }
        else
        {
            header("location:lst_show_admin.php?msg=2&name=$name&date=$date");
        }

        mysqli_close($con);
}
else {
  header("location:lst_show_admin.php?msg=3");
}
?>
