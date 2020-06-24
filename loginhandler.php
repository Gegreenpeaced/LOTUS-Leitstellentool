<?php
if($_POST['send'] == 1337)
{
    session_start();
    $_SESSION = array();
    include("mysql_config.php");
    $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
    mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
    $sql = "SELECT * FROM sys_user WHERE u_nickname='" . $_POST['identifier'] . "' OR u_mail='" . $_POST['identifier'] . "'";
    $res = mysqli_query($con, $sql); //Auswahl der Tabelle
    if(mysqli_num_rows($res) > 0)
    {
    $dsatz = mysqli_fetch_assoc($res);
    if(password_verify($_POST['password'], $dsatz['u_pass']))
    {
        $_SESSION['valid_user'] = true;
        $_SESSION['mail'] = $dsatz['u_mail'];
        $_SESSION['username'] = $dsatz['u_nickname'];             // DOES NOT EVEN WORK... ASK AKKUBAHN FOR IMPROVE!
        $_SESSION['rechte'] = $dsatz['u_rechte'];
        $_SESSION['dark'] = $dsatz['darkth'];
        mysqli_close($con);
        $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
        mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
        $date_last = date('D d M Y, h:i');
        $sql3 = "UPDATE sys_user SET date_last = '" . $date_last . "' WHERE u_nickname='" . $_POST['identifier'] . "' OR u_mail='" . $_POST['identifier'] . "'";
        mysqli_query($con, $sql3);
        header("location:dash.php?l=1");
    }
    else
    {
        $_SESSION = array();
        mysqli_close($con);
        header("location:login.php?error=2");
    }
    }
    else
    {
        $_SESSION = array();
        mysqli_close($con);
        header("location:login.php?error=1");
    }
  }
  else {
  header("location:login.php?error=4");
  }
?>
