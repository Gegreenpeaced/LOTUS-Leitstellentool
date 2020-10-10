<?php
require("downchecker.php");
include("sessionssetter_a.php");

require 'mysqlConnection.php';

//TODO get real players
$players = array();

foreach($pdo->query("SELECT * FROM status") as $row) {
  array_push($players, $row['number']);
}

if(isset($_GET['getChat'])) {
  $sql = "SELECT * FROM notifications";

  $response = array();
  $messages = array();

  foreach($pdo->query($sql) as $row) {
    $message = array();
    $message['sender'] = $row['sender'];
    $message['target'] = $row['target'];
    $message['text'] = $row['text'];
    $message['timestamp'] = date('d.m.Y H:i:s', strtotime($row['timestamp']));

    array_push($messages, $message);
  }

  $response['messages'] = $messages;

  echo json_encode($response);

  return;
}

if(isset($_GET['action']) && $_GET['action'] == "sendNotification") {
  if(!empty($_GET['username']) && !empty($_GET['text'])) {
    $username = $_GET['username'];
    $text = $_GET['text'];

    if($username == "ALLE") {
      foreach($players as $username) {
        $sql = "INSERT INTO notifications(sender, target, text) VALUES('Leitstelle', '" . $username . "', '" . $text . "');";
        $pdo->exec($sql);
      }
    } else {
      $sql = "INSERT INTO notifications(sender, target, text) VALUES('Leitstelle', '" . $username . "', '" . $text . "');";
      $pdo->exec($sql);
    }

    return;
  }
} else if(isset($_GET['action']) && $_GET['action'] == "getStatus") {
  $sql = "SELECT * FROM status";

  $statuses = array();

  foreach($pdo->query($sql) as $row) {
    $status = array();
    $status['username'] = $row['username'];
    $status['number'] = $row['number'];
    $status['destination'] = $row['destination'];
    $status['status'] = $row['status'];
    $status['delay'] = $row['delay'];

    array_push($statuses, $status);
  }

  echo json_encode($statuses);

  return;
}
?>
<!DOCTYPE html>
<html lang="de">
    <head>
      <?php
        include("meta.php");
      ?>
      <title>LEITSTELLE | LOTUS-Leitstelle</title>

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
                <header class="content-header">LEITSTELLE</header>
                <?php
                if($_GET['msg'] == 1)
                {
                echo "<div class='info-box-sucess'>";
                    echo "<div class='sucess'>Erfolg! Leitstellenfahrt erfolgreich gestartet!</div>";
                echo "</div>";
                }
                ?>
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
                        <h1 class="content-box-text-h1">Nutzerübersicht</h1>

                        <div class="content-box-text" id="user-overview-content"></div>
                    </div>
                    <div class="content-box-nospace-long">
                      <h1 class="content-box-text-h1">Sprechwünsche</h1>

                      <div class="content-box-text" id="speaking-wishes-content"></div>
                    </div>
                    <div class="content-box-nospace-long">
                      <h1 class="content-box-text-h1">Statusmeldungen</h1>

                      <div class="content-box-text" id="status-content"></div>
                    </div>
                    <div class="content-box-nospace-long" id="chat-container">
                        <h1 class="content-box-text-h1">Anweisungen</h1>

                        <div class="content-box-text" id="chat-content"></div>

                        <select id="username">
                          <option>ALLE</option>
                          <option disabled>--------------</option>
                          <?php
                            foreach($players as $player) {
                              echo('<option>' . $player . '</option>');
                            }
                          ?>
                        </select>
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

        <script src="js/liveboard_admin.js"></script>
    </body>
</html>
