<?php
if($_POST['send'] == 1337)
{
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank

    $res = mysqli_query($con, "SELECT * FROM `lst_maps`"); //Auswahl der Tabelle
    $sql = "INSERT INTO `lst_maps`(m_name, m_vehicle, m_typ, m_gauge, m_sconfig) VALUES ('" . $_POST['map_name'] . "','" . $_POST['map_vehicles'] . "','" . $_POST['map_type'] . "','" . $_POST['map_gauge'] . "','" . $_POST['map_s_config'] . "')";
    mysqli_query($con, $sql);
    $map = $_POST['map_name'];
    $num = mysqli_affected_rows($con);
    if ($num > 0)
        {
            header("location:maps.php?change=1&map=$map");
        }
        else
        {
            header("location:maps.php?change=2&map=$map");
        }

        mysqli_close($con);
}
else {
  header("location:maps.php?maps=3");
}
?>
