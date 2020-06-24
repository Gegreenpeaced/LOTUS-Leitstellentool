<?php
  require 'mysqlConnection.php';

  if(!empty($_GET['username'])) {
    $username = $_GET['username'];

    if(isset($_GET['del'])) {
      $sql = "DELETE FROM notifications WHERE username='" . $username . "'";
      $pdo->exec($sql);

      return;
    }

    $sql = "SELECT * FROM notifications WHERE username='" . $username . "'";

    $response = array();
    $messages = array();

    foreach($pdo->query($sql) as $row) {
      $message = array();
      $message['text'] = $row['text'];
      $message['timestamp'] = date('d.m.Y H:i:s', strtotime($row['timestamp']));

      array_push($messages, $message);
    }

    $response['username'] = $username;
    $response['messages'] = $messages;

    echo json_encode($response);

    return;
  }
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nachrichten empfangen</title>

    <link rel="stylesheet" href="css/receiveNotification.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div align=center>
      <h1>Nachrichten empfangen</h1>
    </div>

    <div id="form-container">
      <input type="text" name="username" placeholder="Spielername">
      <input type="submit" value="Empfangen" onclick="subscribeToNotifications(this)" id="subscribeToNotifications">
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

    <script src="js/receiveNotification.js"></script>
  </body>
</html>
