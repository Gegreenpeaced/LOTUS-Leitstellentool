<?php
  require 'mysqlConnection.php';

  //TODO get real players
  $players = array('test', 'test2', 'test3');

  if(!empty($_GET['username']) && !empty($_GET['text'])) {
    $username = $_GET['username'];
    $text = $_GET['text'];

    if($username == "ALLE") {
      foreach($players as $username) {
        $sql = "INSERT INTO notifications(username, text) VALUES('" . $username . "', '" . $text . "');";
        $pdo->exec($sql);
      }
    } else {
      $sql = "INSERT INTO notifications(username, text) VALUES('" . $username . "', '" . $text . "');";
      $pdo->exec($sql);
    }

    return;
  }
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>Nachrichten senden</title>

    <link rel="stylesheet" href="css/sendNotification.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div align=center>
      <h1>Nachrichten senden</h1>
    </div>

    <div id="form-container">
      <label class="text" for="username">Spieler</label>
      <select id="username" name="username">
        <option>ALLE</option>
        <option disabled>--------------</option>
        <?php
          foreach($players as $player) {
            echo('<option>' . $player . '</option>');
          }
        ?>
      </select>

      <label class="text" for="text">Text</label>
      <input type="text" id="text" name="text" placeholder="Text">
      <input type="submit" value="Senden" onclick="sendNotification(this)" id="sendNotification">
    </div>

    <div id="infoModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">&times;</span>
          <h2 id="modalHeaderText" />
        </div>
        <div class="modal-body">
          <p id="modalText" />
        </div>
      </div>
    </div>

    <script src="js/sendNotification.js"></script>
  </body>
</html>
