function subscribeToNotifications(item) {
  let parentElement = item.parentElement;

  let username = parentElement.children[0].value;

  if(username == "") return;

  setInterval(receiveNotifications, 1000, username);
}

function receiveNotifications(username) {
  $.ajax({url: "receiveNotification.php?username=" + username, success: function(response) {
    let json = JSON.parse(response);
    let jsonUsername = json.username;
    let jsonMessages = json.messages;

    if(jsonUsername != username) return;
    if(jsonMessages.length == 0) return;

    if(jsonMessages.length == 1) {
      displayModal("Nachricht von Leitstelle", jsonMessages[0].text, "#5cb85c", username);
    } else {
      let text = '';

      jsonMessages.forEach((message, index) => {
        text += message.timestamp + ': ' + message.text;

        if(index != jsonMessages.length - 1) {
          text += '<br><br>';
        }
      });

      displayModal("Nachrichten von Leitstelle", text, "#5cb85c", username);
    }
  }, error: function(xhr, response, error) {
    displayModal("Fehler", "Es ist ein Fehler aufgetreten", "#af081f", username);
  }});
}

function displayModal(header, text, color, username) {
  let modal = document.getElementById('infoModal');
  let modalHeaderText = document.getElementById('modalHeaderText');
  let modalText = document.getElementById('modalText');
  let modalFooterText = document.getElementById('modalFooterText');
  let span = document.getElementsByClassName("close")[0];

  modal.style.display = "block";

  modalHeaderText.parentElement.style.backgroundColor = color;
  modalHeaderText.innerHTML = header;
  modalText.innerHTML = text;

  span.onclick = function() {
    $(modal).animate({opacity: 0}, "500ms", function() {
      $(modal).css("display", "none").css("opacity", "1");
    });

    $.ajax({url: "receiveNotification.php?del&username=" + username});
  }

  window.onclick = function(event) {
    if(event.target == modal) {
      span.onclick();
    }
  }
}
