<?php
require("downchecker.php");
include("sessionssetter.php");

require("mysql_config.php");
$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
$sql_wagen = "SELECT `z_fahr`, `z_umlauf`, `z_spawn` `z_prim_umlauf` FROM `lst_login_fahrt` WHERE `l_user`='" . $_SESSION['username'] . "'";
$res = mysqli_query($con, $sql_wagen);
$dsatz = mysqli_fetch_assoc($res);
$_SESSION['wagen'] = $dsatz['z_fahr'];


$umlauf= $dsatz['z_umlauf'];
$spawn = $dsatz['z_spawn'];

$sql_map = "SELECT * FROM `lst_fahrten` WHERE `lst_u_login`='1'";
$res_map = mysqli_query($con, $sql_map);
$data_map = mysqli_fetch_assoc($res_map);
$map = $data_map['lst_map'];

$sql_fahrzeug = "SELECT `f_typ` FROM `lst_fahrzeuge` WHERE `f_nmr`='" . $dsatz['wagen'] . "'";
$res_fahrzeug = mysqli_query($con, $sql_fahrzeug);
$data_fahrzeug = mysqli_fetch_assoc($res_fahrzeug);
$fahrzeug = $data_fahrzeug['f_typ'];

$sql_route_card = "SELECT `link` FROM `dl_center` WHERE `prim` = '" . $dsatz['z_prim_umlauf'] . "'";
$res_route_card = mysqli_query($con, $sql_route_card);
$data_route_card = mysqli_fetch_assoc($res_route_card);
$dl_link = $data_route_card['link'];



require 'mysqlConnection.php';

if(isset($_GET['getChat'])) {
  $sql = "SELECT * FROM notifications WHERE target='" . $_SESSION['wagen'] . "' OR sender='" . $_SESSION['wagen'] . "'";

  $response = array();
  $messages = array();

  foreach($pdo->query($sql) as $row) {
    $message = array();
    $message['sender'] = $row['sender'];
    $message['text'] = $row['text'];
    $message['timestamp'] = date('d.m.Y H:i:s', strtotime($row['timestamp']));

    array_push($messages, $message);
  }

  $response['messages'] = $messages;

  echo json_encode($response);

  return;
}

if(isset($_GET['action']) && $_GET['action'] == "sendNotification") {
  if(!empty($_GET['text'])) {
    $username = $_SESSION['wagen'];
    $text = $_GET['text'];

    $sql = "INSERT INTO notifications(sender, target, text) VALUES('" . $username . "', 'Leitstelle', '" . $text . "');";
    $pdo->exec($sql);

    return;
  }
} else if(isset($_GET['action']) && $_GET['action'] == "sendStatus") {
  if(!empty($_GET['destination']) && !empty($_GET['status']) && !empty($_GET['delay'])) {
    $username = $_SESSION['username'];
    $number = $_SESSION['wagen'];
    $destination = $_GET['destination'];
    $status = $_GET['status'];
    $delay = $_GET['delay'];

    $sql = "SELECT * FROM status";

    $firstSet = true;

    foreach($pdo->query($sql) as $row) {
      if($username == $row['username']) {
        $firstSet = false;
      }
    }

    if($firstSet) {
      $sql = "INSERT INTO status(username, number, destination, status, delay) VALUES('" . $username . "', '" . $number . "', '" . $destination . "', '" . $status . "', '" . $delay . "');";
    } else {
      $sql = "UPDATE status SET number='" . $number . "', destination='" . $destination . "', status='" . $status . "', delay='" . $delay . "' WHERE username='" . $username . "';";
    }

    $pdo->exec($sql);

    return;
  }
}
?>

<!DOCTYPE html>
<html lang="de">
    <head>
      <?php
        include("meta.php");
      ?>
      <title>Liveboard | LOTUS-Leitstelle</title>

      <link rel="stylesheet" href="css/main.css">

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <main class="app">
            <nav class="sidebar">
                <header class="sidebar-header">
                  <?php
                    include("navmenu.php");
                    include("footer.php");
                  ?>
                </header>
            </nav>
            <nav class="space">
            </nav>
            <nav class="content">
                <header class="content-header">Liveboard</header>
                <div class="content-main">
                    <div class="content-box">
                      <div class="content-box-space-small">
                      </div>
                      <div class="content-box-space-small">
                      </div>
                      <div class="content-box-space-small">
                      </div>
                      <div class="content-box-space-small">
                      </div>
                    </div>
                    <div class="content-box">
                    <div class="content-box-nospace-long">
                        <div class="content-box-text">
                            <h1 class="content-box-text-h1">Fahrtzettel</h1>
                            <h2 class="content-box-text-h2">Karte: <?php echo $map; ?></h2>
                            <h2 class="content-box-text-h2">Wagennummer: <?php echo $_SESSION['wagen']; ?></h2>
                            <h2 class="content-box-text-h2">Fahrzeug: <?php echo $fahrzeug; ?></h2>
                            <h2 class="content-box-text-h2">Spawnpunkt: <?php echo $spawn; ?></h2>
                            <h2 class="content-box-text-h2">Umlauf: <?php echo $umlauf; ?></h2>
                        </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Downloads</h1>
                        <h2 class="content-box-text-h2">Umlaufkarte: <?php echo "<a href='" . $dl_link . "'<button class='lstbutton-login'>Download</button></a>" ?></h2>
                        <!--<h2 class="content-box-text-h2">Fahrzeug-Handbuch: <button disabled class="lstbutton-login">Download</button></h2>        // GGF später hinzufügen!-->
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text" id="status-content">
                        <h1 class="content-box-text-h1">Statusmeldungen</h1>
                        <h2 class="content-box-text-h2">Ziel: <select id="desti_stat_lst" onchange="sendStatus()">
                          <?php
                          require("mysql_config.php");
                          $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
                          mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
                          $sql_routes = "SELECT * FROM `sys_dest` WHERE `map`='$map'";
                          $res_routes = mysqli_query($con, $sql_routes);
                          $num_routes = mysqli_num_rows($res_routes);
                          if($num_routes > 0)
                          {
                            while($dsatz = mysqli_fetch_assoc($res_routes))
                            {
                              echo "<option name='". $dsatz['dest'] . "'>" . $dsatz['dest'] . "</option>";
                            }
                          }
                          else {
                            echo "<option name='N/A'>N/A</option>";
                          }
                           ?>
                          </select></h2>
                        <h2 class="content-box-text-h2">Statusmeldungen: <select id="status_stat_lst" onchange="sendStatus()"><option name="none">Kein Sprechwunsch</option><option name="other">Unkodiert</option><option name="delay">Verspätet</option><option name="accident">Unfall</option></select></h2>
                        <h2 class="content-box-text-h2">Verspätungen: <select id="delay_stat_lst" onchange="sendStatus()"><option id="pünktlich">0 Minuten</option><option id="5 min">über 5 Minuten</option><option id="10 min">über 10 Minuten</option><option id="über 15 min">über 15 Minuten</option></select></h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long" id="chat-container">
                      <h1 class="content-box-text-h1">Anweisungen der Leitstelle</h1>
                      <div class="content-box-text" id="chat-content"></div>
                    </div>
                  </div>
                </div>
            </nav>
            <nav class="logout-bar">
                &nbsp;
            </nav>
            <br>
        </main>

        <script src="js/liveboard_user.js"></script>
    </body>
</html>
