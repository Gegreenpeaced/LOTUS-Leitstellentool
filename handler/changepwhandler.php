<?php
require("downchecker.php");
session_start();
$mail = $_POST['mail'];
$password_old = $_POST['password_old'];
$password_new = $_POST['password_new'];
$password_new_2 = $_POST['password_new_2'];
$username = $_POST['username'];

      if($password_new == $password_new_2)
      {
        include("mysql_config.php");
        $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
        mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
        $mail = $_SESSION['mail'];
        $sql = "SELECT * FROM `sys_user` WHERE `u_mail` = '$mail'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0)
        {
          $dsatz = mysqli_fetch_assoc($res);
          if(password_verify($password_old, $dsatz['u_pass']))
          {
            $new_pw_hash = password_hash("$password_new", PASSWORD_DEFAULT);
            $sql_update = "UPDATE `sys_user` SET `u_pass` = '$new_pw_hash' WHERE `u_mail` = '$mail'";
            $res_update = mysqli_query($con, $sql_update);
            $num = mysqli_affected_rows($con);

            if($num > 0)
            {
              $to = $_SESSION['mail'];
              $name = $dsatz['u_name'];
              $date = date('D d M Y, h:i');
              $nachname = $dsatz['u_nachname'];
              $subject = 'Dein Passwort wurde geändert!';
              $message = 'Hallo ' . $name . ' ' . $nachname . '.<br><br>
                    Am ' . $date . ' wurde dein Passwort für die LOTUS - Leitstelle geändert.<br>Das warst nicht du?<br>
                    Dann Kontaktiere umgehend einen Administrator.
                    <br>
                    <br><br>
                    Dein LOTUS-Leitstellenteam';

              $headers = 'From: noreply@ivb-community.de' . "\r\n" . 'Reply-To: support@ivb-community.de' . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n" . 'MIME-Version: 1.0';

              mail($to, $subject, $message, $headers);
              $_SESSION = array();
              header("location:login.php?msg=1");
            }
            else {
              header("location:logout.php?msg=2");
            }
          }
          else {
            header("location:changepw.php?msg=1");
          }
        }
      else {
        header("location:changepw.php?msg=2");
      }
    }
