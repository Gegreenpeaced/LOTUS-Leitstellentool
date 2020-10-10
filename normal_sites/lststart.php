<?php
require("downchecker.php");
if($_POST['send'] == 1337)
{
  require("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
  $date = $_POST['date'];
  $sql_user_login_impossible = "UPDATE `lst_fahrten` SET `lst_u_login`='1' WHERE `lst_date` = '$date'"; // Macht den Nutzerlogin unmöglich!
  $res_user_login_impossible = mysqli_query($con, $sql_user_login_impossible);


  $sql_status_truncate = "TRUNCATE TABLE `status`";                                                                                   //--
  $res_status_truncate = mysqli_query($con, $sql_status_truncate);                                                                    // Leert die "STATUS" Tabelle für das Liveboard!
  $num_status_truncate = mysqli_affected_rows($con);                                                                               //-- DELETE FROM `status`

  mysqli_query($con, "DELETE FROM `notifications`");

  $sql_notification_hello = "INSERT INTO `notifications` (`sender`, `text`) VALUES ('SYSTEM', 'Leitstellenfahrt startet! Bitte Nutzen sie diesen Chat zur primären Kommunikation!')";
  $res_notification_hello = mysqli_query($con, $sql_notification_hello);

  //if($num_status_truncate > 0)        // Truncate erfolgreich ?
  //{
    mysqli_query($con, "UPDATE `sys_user` SET `lst_mode`='1337'");
    $sql_user_noliveboard = "UPDATE `sys_user` SET `lst_mode`='0'";                       //--
    $res_user_noliveboard = mysqli_query($con, $sql_user_noliveboard);                    // Deaktiviert bei jedem Nutzer das Liveboard!
    $num_user_noliveboard = mysqli_affected_rows($con);                                   //--

    if($num_user_noliveboard > 0)     // Liveboard setzen erfolgreich ?
    {

      $sql_numbers_user = "SELECT * FROM `lst_login_fahrt` WHERE `lst_confirm`='1'"; //--
      $res_numbers_user = mysqli_query($con, $sql_numbers_user);                            // Ermittelt die Anzahl der Menschen mit einer gültigen Anmeldung!
      $num_numbers_user = mysqli_num_rows($res_numbers_user);                               //--


      while($data_user_set_liveboard = mysqli_fetch_assoc($res_numbers_user))               // Nutzern das Liveboard einschalten!
      {
        $sql_liveboard_activate = "UPDATE `sys_user` SET `lst_mode`='1' WHERE `u_nickname` = '" . $data_user_set_liveboard['l_user'] . "'";
        mysqli_query($con, $sql_liveboard_activate);

        $name = $data_user_set_liveboard['l_user'];
        $number = $data_user_set_liveboard['z_fahr'];
        $dest = "N/A";
        $status = "Kein Sprechwunsch";
        $delay = "0";
        $sql_insert_status = "INSERT INTO `status` (`username`, `number`, `destination`, `status`, `delay`) VALUES ('$name', '$number', '$dest', '$status', '$delay')";
        mysqli_query($con, $sql_insert_status);
      }

      header("location:liveboard_admin.php?msg=1");
    }

    else {
      echo "Liveboard auf 0 setzen war nicht erfolgreich!";
    }
  //}

  //else {
    //echo "Truncate war nicht erfolgreich!";
  //}

}
else {
      echo "Formular nicht manipulieren!";
}

 ?>
