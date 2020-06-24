<?php
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
              $message = '
              <html>
                <head>
                  <style>
                  body {
                    margin: 0;
                    padding: 0;
                    font-family: sans-serif;
                    background: #34495e;
                  }
                  a{
                    text-decoration: none;
                  }
                  .login {
                    width: 300px;
                    padding: 40px;
                    position: absolute;
                    top: 30%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: #191919;
                  }
                  .login h1{
                    color: white;
                    font-size: 30px;
                    font-weight: 50;
                    text-align: center;
                  }
                  .login h4 {
                    color: white;
                    font-size: 16px;
                    font-weight: 100;
                  }
                  .login input[type = "submit"] {
                    border: 0;
                    background: none;
                    display: block;
                    margin: 20px auto;
                    text-align: center;
                    border: 2px solid #2ecc71;
                    padding: 8px 35px;
                    outline: none;
                    color: white;
                    transition: 0.25s;
                    cursor: pointer;
                  }
                  .login input[type = "submit"]:hover {
                    background: #2ecc71;
                  }
                  </style>
                  <meta http-equiv="X-UA-Compatible" content="ie=edge">
                  <title>Dein Passwort wurde geändert | LOTUS-Leitstelle</title>
                </head>
                <body>
                  <div class="login">
                  <form class="login" action="Link eingeben!" method="post">
                    <h1>LOTUS Leitstelle</h1>
                    <h4>Hallo ' . $name . ' ' . $nachname . '.<br><br>
                    Am ' . $date . ' wurde dein Passwort für die LOTUS - Leitstelle geändert.<br>Das warst nicht du?<br>
                    Dann Kontaktiere umgehend einen Administrator.
                    <br>
                    <br><br>
                    Dein LOTUS-Leitstellenteam
                    </h4>
                    <input type="submit" value="Anmelden"></input>
                  </div>
                  </form>
                </body>
              </html>
              ';

              $headers = 'From: noreply@drblackerror.de' . "\r\n" . 'Reply-To: support-lst@drblackerror.de' . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n" . 'MIME-Version: 1.0';

              mail($to, $subject, $message, $headers);

              header("location:login.php?msg=1");
              $_SESSION = array();
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
