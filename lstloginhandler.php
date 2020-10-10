<?php
require("downchecker.php");
if($_POST['send'] == 1337)
  {
    require("mysql_config.php");
    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
    $user = $_POST['name'];
    $vehicle = $_POST['vehicle'];
    $spawn = $_POST['spawn'];
    $sql_route_prim = "SELECT `r_prim` FROM `lst_routes` WHERE `r_nmr` = '" . $_POST['route'] . "' AND `r_map` = '" . $_POST['map'] . "'";
    $res_route_prim = mysqli_query($con, $sql_route_prim);
    $num_route_prim = mysqli_num_rows($res_route_prim);
    if($num_route_prim > 0)
    {
    $data_prim_route = mysqli_fetch_assoc($res_route_prim);
    $status_sql = "UPDATE `lst_login_fahrt` SET `z_prim_umlauf`='" . $data_prim_route['z_prim_umlauf'] . "', `z_umlauf`='" . $_POST['route'] . "', `z_fahr`='$vehicle', `z_spawn`='$spawn', `lst_confirm`='1' WHERE `l_user`='$user'";
    mysqli_query($con, $status_sql);
    $num = mysqli_affected_rows($con);
    if($num > 0)
    {
      $sql_vehicle_update = "UPDATE `lst_fahrzeuge` SET `used`='1' WHERE `f_nmr`='$vehicle'";
      mysqli_query($con, $sql_vehicle_update);
      $num_vehicle = mysqli_affected_rows($con);
      if($num_vehicle > 0)
      {
        $sql_name = "SELECT * FROM `sys_user` WHERE `u_nickname`='$user'";
        $res_sys_user = mysqli_query($con, $sql_name);
        $data_sys_user = mysqli_fetch_assoc($res_sys_user);

        $sql_lst_data = "SELECT * FROM `lst_fahrten`";
        $res_lst_data = mysqli_query($con, $sql_lst_data);
        $data_sys_lst = mysqli_fetch_assoc($res_lst_data);

        // Mail Variablen
        $to = $data_sys_user['u_mail'];
        $name = $data_sys_user['u_name'];
        $nachname = $data_sys_user['u_nachname'];
        $lst_name = $data_sys_lst['lst_name'];
        //$time = ;               // FEATURE NOCH NICHT IMPLEMENTIERT!
        $date = $data_sys_lst['lst_date'];
        $subject = 'Deine Anmeldung wurde akzeptiert!';
        $message = 'Hallo ' . $name . ' ' . $nachname . '.<br><br>
              Die Anmeldung für die Leitstellenfahrt "' . $lst_name . '" wurde von einem Admin akzeptiert.<br>Sie beginnt am: ' . $date . '.<br>Wir freuen uns auf dich!
              <br>
              <br><br>
              Dein LOTUS-Leitstellenteam';

        $headers = 'From: noreply@ivb-community.de' . "\r\n" . 'Reply-To: support@ivb-community.de' . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n" . 'MIME-Version: 1.0';

        mail($to, $subject, $message, $headers);
        mysqli_close($con);
        header("location:lst_admin_login_confirm.php?msg=1");
      }

      else
      {
      header("location:lst_admin_login_confirm.php?msg=2");
    }
    }
    else {
      header("location:lst_admin_login_confirm.php?msg=4");
    }
  }
  else {
    header("location:lst_admin_login_confirm.php?msg=4");
  }
  }

  else {
    header("location:lst_admin_login_confirm.php?msg=3");
  }
 ?>
