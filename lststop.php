<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
  require("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank

  $sql_user_normal = "UPDATE `sys_user` SET `lst_mode`='1'";                    //--
  mysqli_query($con, $sql_user_normal);
  $sql_user_normal_final = "UPDATE `sys_user` SET `lst_mode`='0'";              // Nutzern wieder das Dashboard anschalten
  mysqli_query($con, $sql_user_normal_final);                                   //--

  $sql_lst_stop = "DELETE FROM `notifications`";                                //--
  $res_lst_stop = mysqli_query($con, $sql_lst_stop);                            // Notficiations bereinigen!
  $sql_lst_stop_2 = "INSERT INTO `notifications` (`sender`, `text`) VALUES ('SYSTEM', 'Leitstellenfahrt BEENDET! Normalerweise ist das nur ein Platzhalter für den eig. TRUNCATE!')";
  $res_lst_stop_2 = mysqli_query($con, $sql_lst_stop_2);
  $num_lst_stop = mysqli_affected_rows($con);                                   //--

  if($num_lst_stop > 0)
  {
    $sql_lst_status_clear = "DELETE FROM `status`";                             //--
    $res_lst_status_clear = mysqli_query($con, $sql_lst_status_clear);          // Leert den STATUS und bereitet TRUNCATE vor!
    $sql_lst_status_clear_2 = "INSERT INTO `status` (`username`, `destination`, `status`) VALUES ('SYSTEM', 'LEITSTELLENFAHRT BEENDET', 'WARTET AUF TRUNCATE')";
    $res_lst_status_clear_2 = mysqli_query($con, $sql_lst_status_clear_2);
    $num_lst_status_clear = mysqli_affected_rows($con);                         //--

    if($num_lst_status_clear > 0)
    {
      $sql_vehicle_set_zero_save = "UPDATE `lst_fahrzeuge` SET `used` = '1'";        //--
      mysqli_query($con, $sql_vehicle_set_zero_save);                                 // Setzt Fahrzeuge 'benutzt' auf 1 (save damit die Schleife nicht 0 ergeben kann!)


      $sql_vehicle_set_zero = "UPDATE `lst_fahrzeuge` SET `used` = '0'";        //--
      $res_vehicle_set_zero = mysqli_query($con, $sql_vehicle_set_zero);        // Setzt Fahrzeuge 'benutzt' auf 0
      $num_vehicle_set_zero = mysqli_affected_rows($con);                       //--

      if($num_vehicle_set_zero > 0)
      {
        $sql_user_login_clear = "DELETE FROM `lst_login_fahrt`";                //--
        $res_user_login_clear = mysqli_query($con, $sql_user_login_clear);      // Setzt alle Anmeldungen zurück!
        $num_user_login_clear = mysqli_affected_rows($con);                     //--

        $sql_lst_stop_db = "UPDATE `lst_fahrten` SET `lst_u_login`='0'";        //--
        $res_lst_stop_db = mysqli_query($con, $sql_lst_stop_db);                //Login is now possible!
        $num_lst_stop_db = mysqli_affected_rows($con);                            //--

        if($num_lst_stop_db > 0)
        {
          header("location:lst_show_admin.php?msg=11");
        }
        else {
          header("location:lst_show_admin.php?msg=16");
        }
      }
      else {
        header("location:lst_show_admin.php?msg=12");
      }
    }
    else {
      header("location:lst_show_admin.php?msg=13");
    }
    }
    else {
      header("location:lst_show_admin.php?msg=14");
    }
  }
else {
  header("location:lst_show_admin.php?msg=15");
}
?>
