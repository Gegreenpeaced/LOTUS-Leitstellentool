<?php
//include("sessionssetter.php");

require 'mysqlConnection.php';

$_SESSION['username'] = 'Testuser';
$_SESSION['wagen'] = '9999';

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
        //include("meta.php");
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
                    //include("navmenu.php");
                    //include("footer.php");
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
                            <h2 class="content-box-text-h2">Karte: $map
                            <h2 class="content-box-text-h2">Wagennummer: $vehicle_number</h2>
                            <h2 class="content-box-text-h2">Fahrzeug: $vehicle_typ</h2>
                            <h2 class="content-box-text-h2">Umlauf: $route</h2>
                        </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Downloads</h1>
                        <h2 class="content-box-text-h2">Umlaufkarte: <button class="lstbutton-login">Download</button></h2>
                        <h2 class="content-box-text-h2">Fahrzeug-Handbuch: <button class="lstbutton-login">Download</button></h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text" id="status-content">
                        <h1 class="content-box-text-h1">Statusmeldungen</h1>
                        <h2 class="content-box-text-h2">Ziel: <select id="desti_stat_lst" onchange="sendStatus()"><option name="d_loerik">D. Lörick</option><option name="d_hbf">D. Hauptbahnhof</option></select></h2>
                        <h2 class="content-box-text-h2">Statusmeldungen: <select id="status_stat_lst" onchange="sendStatus()"><option name="none">Kein Sprechwunsch</option><option name="delay">Verspätet</option><option name="accident">Unfall</option></select></h2>
                        <h2 class="content-box-text-h2">Verspätungen: <select id="delay_stat_lst" onchange="sendStatus()"><option id="5">über 5 Minuten</option><option id="10">über 10 Minuten</option><option id="15plus">über 15 Minuten</option></select></h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long" id="chat-container">
                      <h1 class="content-box-text-h1">Anweisungen der Leitstelle</h1>
                      <div class="content-box-text" id="chat-content"></div>

                      <input class="submit-input-contentbox" type="text" placeholder="Nachricht" id="text">
                      <input type="submit" class="lstbutton-login" value="Senden" onclick="sendNotification(this)" id="sendNotification">
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
