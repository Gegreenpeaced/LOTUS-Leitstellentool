<?php

include("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql = "SELECT `lst_mode` FROM `sys_user` WHERE `u_mail` = '" . $_SESSION['mail'] . "'";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) > 0)
{
  $dsatz = mysqli_fetch_assoc($res);
  if($dsatz['lst_mode'] == 1)
  {
    $lst_live = "1";
  }
  else {
    $lst_live = "0";
  }
}
else {
  $lst_live = "0";
}
mysqli_close($con);


echo "<a href='index.php'><img src='img/dash_logo.png' width='230px'></a>";
echo "</header>";
echo "<div class='sidebar-groups'>";
echo "<h3>Navigationsmenü</h3>";
echo "<div class='navmenu'>";




if($_SESSION['rechte'] > 0)
{
if($lst_live == 1)
{
echo "<a href='liveboard_user.php'><button class='navbutton'>Liveboard</button></a>";
echo "<br>";
echo "<a href='lst_show_user.php'><button class='navbutton'>Leitstellenfahrten</button></a>";
echo "<br>";
echo "<a href='usershow_user.php'><button class='navbutton'>Nutzerübersicht</button></a>";
echo "<br>";
echo "<a href='d_center.php'><button class='navbutton'>Download Center</button></a>";
echo "<br>";
echo "<br>";
if($_SESSION['rechte'] > 1)
{
echo "<h4>Administration</h4>";
echo "<br>";
if($lst_live == 1)
{
echo "<a href='liveboard_admin.php'><button class='navbutton'>Leitstelle</button></a>";
echo "<br>";
}
echo "<a href='usershow_admin.php'><button class='navbutton'>Nutzerverwaltung</button></a>";
echo "<br>";
echo "<a href='lst_show_admin.php'><button class='navbutton'>Leitstellenfahrten</button></a>";
echo "<br>";
echo "<a href='fahrzeuge.php'><button class='navbutton'>Fahrzeuge</button></a>";
echo "<br>";
echo "<a href='maps.php'><button class='navbutton'>Betriebskarten</button></a>";
echo "<br>";
echo "<a href='route.php'><button class='navbutton'>Umläufe</button></a>";
echo "<br>";
echo "<a href='d_center_admin.php'><button class='navbutton'>Download Center</button></a>";
echo "<br>";
echo "<a href='system.php'><button class='navbutton'>Systemeinstellungen</button></a>";
echo "<br>";
echo "<br>";
}
echo "<h4>Sonstiges</h4>";
echo "<br>";
echo "<a href='https://www.github.com/Gegreenpeaced'><button class='navbutton'>Fehler melden!</button></a>";
echo "<br>";
echo "<a href='settings.php'><button class='navbutton'>Einstellungen</button></a>";
echo "<br>";
echo "<a href='impressum.php'><button class='navbutton'>Impressum</button></a>";
echo "<br>";
echo "<button class='navbutton'>&nbsp;</button>";
echo "<br>";
echo "<a href='logout.php'><button class='navbutton'>Logout</button></a>";
echo "</div>";
}
else {
  echo "<a href='dash.php'><button class='navbutton'>Dashboard</button></a>";
  echo "<br>";
  echo "<a href='lst_show_user.php'><button class='navbutton'>Leitstellenfahrten</button></a>";
  echo "<br>";
  echo "<a href='usershow_user.php'><button class='navbutton'>Nutzerübersicht</button></a>";
  echo "<br>";
  echo "<a href='d_center.php'><button class='navbutton'>Download Center</button></a>";
  echo "<br>";
  echo "<br>";
  if($_SESSION['rechte'] > 1)
  {
  echo "<h4>Administration</h4>";
  echo "<br>";
  echo "<a href='usershow_admin.php'><button class='navbutton'>Nutzerverwaltung</button></a>";
  echo "<br>";
  echo "<a href='lst_show_admin.php'><button class='navbutton'>Leitstellenfahrten</button></a>";
  echo "<br>";
  echo "<a href='fahrzeuge.php'><button class='navbutton'>Fahrzeuge</button></a>";
  echo "<br>";
  echo "<a href='maps.php'><button class='navbutton'>Betriebskarten</button></a>";
  echo "<br>";
  echo "<a href='route.php'><button class='navbutton'>Umläufe</button></a>";
  echo "<br>";
  echo "<a href='d_center_admin.php'><button class='navbutton'>Download Center</button></a>";
  echo "<br>";
  echo "<a href='system.php'><button class='navbutton'>Systemeinstellungen</button></a>";
  echo "<br>";
  echo "<br>";
  }
  echo "<h4>Sonstiges</h4>";
  echo "<br>";
  echo "<a href='https://www.github.com/Gegreenpeaced'><button class='navbutton'>Fehler melden!</button></a>";
  echo "<br>";
  echo "<a href='settings.php'><button class='navbutton'>Einstellungen</button></a>";
  echo "<br>";
  echo "<a href='impressum.php'><button class='navbutton'>Impressum</button></a>";
  echo "<br>";
  echo "<button class='navbutton'>&nbsp;</button>";
  echo "<br>";
  echo "<a href='logout.php'><button class='navbutton'>Logout</button></a>";
  echo "</div>";
}
}
else
{
  echo "<h4>Sonstiges</h4>";
  echo "<br>";
  echo "<a href='https://www.github.com/Gegreenpeaced'><button class='navbutton'>Fehler melden!</button></a>";
  echo "<br>";
  echo "<a href='impressum.php'><button class='navbutton'>Impressum</button></a>";
  echo "<br>";
  echo "<button class='navbutton'>&nbsp;</button>";
  echo "<br>";
  echo "<a href='index.php'><button class='navbutton'>Startseite</button></a>";
  echo "</div>";
}
?>
