<?php
require("downchecker.php");
$u_pass_unhashed = $_POST['password'];
$u_pass_2 = $_POST['password_2'];
if($u_pass_unhashed == $u_pass_2)
{
$u_name = $_POST['vorname'];
$u_nachname = $_POST['nachname'];
$u_nickname = $_POST['username'];
$mail = $_POST['mail'];
$u_pass = password_hash("$u_pass_unhashed", PASSWORD_DEFAULT);
$u_token = $_POST['token'];
include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$res = mysqli_query($con, "SELECT * FROM sys_token WHERE l_token = $u_token, used = 0"); //Auswahl der Tabelle
if($res['used'] == 0)
    {
        mysqli_query($con, "UPDATE sys_token SET used = 1 WHERE l_token = $u_token");
        $num = mysqli_affected_rows($con);
        if ($num > 0)
        {
            mysqli_close($con);
            $con2 = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
            mysqli_select_db($con2, "$MYSQL_DB"); //Auswahl der Datenbank
            $sql = "INSERT INTO sys_user (u_name, u_nachname, u_nickname, u_mail, u_pass, u_rechte) VALUES ('$u_name','$u_nachname','$u_nickname','$mail','$u_pass','1')";
            mysqli_query($con2, $sql);
            $num2 = mysqli_affected_rows($con2);
            if ($num2 > 0)
            {
                $sql_token_remove = "DELETE FROM `sys_token` WHERE `l_token`='$u_token'";
                mysqli_query($con2, $sql_token_remove);
                mysqli_close($con2);
                $subject = 'Registrierung bei der LOTUS-Leitstelle';
                $message = 'Hallo ' . $u_name . ' ' . $u_nachname . '.<br><br>
                      Willkommen bei der LOTUS-Leitstelle. <br>Dein Account wurde erfolgreich registriert!<br>
                      <br>
                      Dein Nutzername: ' . $u_nickname . '<br><br><br>
                      Dein LOTUS-Leitstellenteam
                ';

                $headers = 'From: noreply@ivb-community.de' . "\r\n" . 'Reply-To: support@ivb-community.de' . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n" . 'MIME-Version: 1.0';

                mail($mail, $subject, $message, $headers);
                header("location:login.php?change=1");
                die;
            }
            else
            {
                header("location:register.php?change=2");
                mysqli_close($con2);
                die;
            }
        }
        else
            {
                header("location:register.php?change=3");
                mysqli_close($con2);
                die;
            }
    }
else
    {
        mysqli_close($con);
        header("location:register.php?change=4");
        die;
    }
  }
  else {
    header("location:register.php?change=5");
  }
?>
