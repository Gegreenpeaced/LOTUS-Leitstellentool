<?php
if($_POST['send'] == 1337)
{
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "DELETE FROM `lst_maps` WHERE `m_name` = '" . $_POST['m_old_name'] . "'";
mysqli_query($con, $sql);
$num = mysqli_affected_rows($con);
if($num > 0)
{
    $sql2 = "INSERT INTO `lst_maps`(m_name, m_vehicle, m_typ, m_gauge, m_sconfig) VALUES ('" . $_POST['map_name_new'] . "','" . $_POST['map_vehicles'] . "','" . $_POST['map_type'] . "','" . $_POST['map_gauge'] . "','" . $_POST['map_h_config'] . "')";
    mysqli_query($con, $sql2);
    $num = mysqli_affected_rows($con);
    if ($num > 0)
        {
          $mname = $_POST['m_old_name'];
          header("location:maps.php?change=6&map=$mname");
          mysqli_close($con);
        }
    else
    {
        $mname = $_POST['m_old_name'];
        header("location:maps.php?change=7&map=$mname");
        mysqli_close($con);
    }
}

else
{
  header("location:maps.php?change=8");
  mysqli_close($con);
}

}
else {
  header("location:maps.php?change=3");
}
?>
