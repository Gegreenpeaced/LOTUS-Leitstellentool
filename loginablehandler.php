<?php
if($_POST['send'] == 1337)
{
  include("mysql_config.php");
  $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
  mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
  $sql = "UPDATE `lst_fahrten` SET lst_login_pb = '1' WHERE `lst_date`='" . $_POST['date'] . "'";
  mysqli_query($con, $sql);
  $num = mysqli_affected_rows($con);
  if($num > 0)
  {
    $sql_lst_board = "UPDATE `system` SET `lst_next_date` = '" . $_POST['date'] . "'";
    mysqli_query($con, $sql_lst_board);
    $num_lst_board = mysqli_affected_rows($con);
    if($num_lst_board > 0)
      {
        $mail_select = "SELECT `u_mail`, `u_name`, `u_nachname` FROM `sys_user`";
        $res = mysqli_query($con, $mail_select);
        while($data = mysqli_fetch_assoc($res))
        {
          $to = $data['u_mail'];
          $date = $_POST['date'];
          $lst_name = $_POST['lst_name'];
          $name = $data['u_name'];
          $nachname = $data['u_nachname'];
          $subject = 'Neue Leitstellenfahrt verfügbar!';
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
              <title>Neues Leitstellenfahrt verfügbar! | LOTUS-Leitstelle</title>
            </head>
            <body>
              <div class="login">
              <form class="login" action="Link eingeben!" method="post">
                <h1>LOTUS Leitstelle</h1>
                <h4>Hallo ' . $name . ' ' . $nachname . '.<br><br>
                Am ' . $date . ' findet die ' . $lst_name . ' Leitstellenfahrt statt.<br>Schau doch mal bei uns rein!<br>
                Für die schnelle Anmeldung klicke einfach auf den Knopf unten.
                <br>
                <br><br>
                Dein LOTUS-Leitstellenteam
                </h4>
                <input type="submit" name="" value="Anmelden"></input>
              </div>
              </form>
            </body>
          </html>
          ';

          $headers = 'From: noreply@drblackerror.de' . "\r\n" . 'Reply-To: support-lst@drblackerror.de' . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n" . 'MIME-Version: 1.0';

          mail($to, $subject, $message, $headers);
        }
        mysqli_close($con);
        header("location:lst_show_admin.php?msg=4");
      }
    else
    {
      header("location:lst_show_admin.php?msg=10");
    }
  }
  else {
    mysqli_close($con);
    header("location:lst_show_admin.php?msg=5");
  }
}
else {
  header("location:lst_show_admin.php?msg=3");
}
?>
