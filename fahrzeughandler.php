<?php
if($_POST['send'] == 1337)
{
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank


    $res = mysqli_query($con, "SELECT * FROM `lst_fahrzeuge`"); //Auswahl der Tabelle

    $sql = "INSERT INTO `lst_fahrzeuge` (f_nmr, f_class, f_stufen, f_zr, f_trak, f_platz, f_gauge) VALUES ('" . $_POST['vehicle_number'] . "','" . $_POST['vehicle_class'] . "','" . $_POST['vehicle_stairs'] . "','" . $_POST['vehicle_twoway'] . "',
    '" . $_POST['vehicle_traction'] . "','" . $_POST['vehicle_people'] . "', '" . $_POST['vehicle_gauge'] . "')";
    mysqli_query($con, $sql);
    $num = mysqli_affected_rows($con);
    if ($num > 0)
        {
            $nmr = $_POST['vehicle_number'];
            header("location:fahrzeuge.php?msg=4&nmr=$nmr");
        }
        else
        {
            $nmr = $_POST['vehicle_number'];
            header("location:fahrzeuge.php?msg=5&nmr=$nmr");
        }

        mysqli_close($con);

}
else {
  header("location:fahrzeuge.php?msg=3");
}
?>
