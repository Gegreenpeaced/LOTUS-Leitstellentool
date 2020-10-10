<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
    include("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
    $prim = uniqid();
    $sql = "INSERT INTO `dl_center`(prim, name, link, cat, date_t, des) VALUES ('$prim','" . $_POST['d_add_name'] . "','" . $_POST['d_file_link'] . "','" . $_POST['d_cat'] . "','" . $_POST['d_add_date'] . "','" . $_POST['d_descript'] . "')";
    echo $sql;
    mysqli_query($con, $sql);
    $num = mysqli_affected_rows($con);
    $cat = $_POST['d_cat'];
    $name = $_POST['d_add_name'];
    if ($num > 0)
        {
            header("location:d_center_admin.php?msg=1&name=$name&cat=$cat");
        }
        else
        {
            header("location:d_center_admin.php?msg=2&name=$name");
        }

        mysqli_close($con);
}
else {
  header("location:d_center_admin.php?msg=3");
}
?>
