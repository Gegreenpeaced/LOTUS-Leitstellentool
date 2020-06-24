<?php
session_start();
$mail = $_POST['mail'];
$password_old = $_POST['password_old'];
$password_new = $_POST['password_new'];
$password_new_2 = $_POST['password_new_2'];
print_r($_SESSION);
echo "<br>";
if($_SESSION['username'] == $_POST['username'])
{
  if($_SESSION['mail'] == $_POST['mail'])
  {
    if($password_new == $password_new_2)
    {
      include("mysqli_config.php");
      $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
      mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
      $mail = $_SESSION['mail'];
      $sql = "SELECT * FROM `sys_user` WHERE `u_mail` = '" . $mail . "'";
      $res = mysqli_query($con, $sql);
      if(mysqli_num_rows($res) > 0)
      {

        echo "hi";
      }
      else {
        echo $sql;
        echo "<br>";
      }
        /*/if(password_verify($password_old, $res['u_pass']))
        {
          echo "true";
        }
        else {
          echo "keine Verbindung möglich";
          echo $sql;
        }/*/
    }
    else {
      echo "Passwörter stimmen nicht überein!";
    }
  }
  else {
    echo "false";
  }
}
/*/
  echo $_POST['username'];
  echo "Hi";
  $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
  mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
  $res2 = mysqli_query($con, "SELECT * FROM sys_user WHERE u_mail = '" . $mail . "' AND u_token = '" . $token . "'"); //Auswahl der Tabelle
  //$pw_db = $res2['u_pass'];
  if($password_new == $password_new_2)
  {
    if(password_verify($password_old, $res2['u_pass']))
      {
        $password_hashed = password_hash("$password_new", PASSWORD_DEFAULT);
        mysqli_query($con, "UPDATE sys_user SET u_pass = '" . $password_hashed . "' WHERE u_mail = '" . $mail . "' AND u_token = '" . $token . "'");
        $num = mysqli_affected_rows($con3);

        if ($num > 0) // Das Passwort
        {
            echo "Hi";
        }
        else {
          echo "Nej";
        }
      }
      else {
        header("location:changepw.php?msg=2"); //Das Passwort stimmt nicht mit dem aus der Datenbank überein.
      }
   }
  else  {
    header("location:changepw.php?msg=1"); //Die neuen Passwörter stimmen nicht überein
  }
}
else
{
  echo "Nein";
  //header("location:changepw.php?msg=3"); // Sind nicht die eigenen Daten lol
}/*/
