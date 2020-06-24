$("#form-container").on("keydown", function(event) {
  if(event.keyCode == 13) {
    sendNotification(document.getElementById("sendNotification"));
  }
});

function sendNotification(item) {
  let parentElement = item.parentElement;

  let username = parentElement.children[1].value;
  let text = parentElement.children[3].value;

  if(username == "" || text == "") return;

  $.ajax({url: "sendNotification.php?username=" + username + "&text=" + text, success: function(response) {
    if(username == "ALLE") {
      displayModal("Information", "Du hast allen Spielern eine Benachrichtigung mit dem Text \"" + text + "\" geschickt.", "#5cb85c");
    } else {
      displayModal("Information", "Du hast dem Spieler \"" + username + "\" eine Benachrichtigung mit dem Text \"" + text + "\" geschickt.", "#5cb85c");
    }
  }, error: function(xhr, response, error) {
    displayModal("Fehler", "Es ist ein Fehler aufgetreten", "#af081f");
  }});
}

function displayModal(header, text, color) {
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
  }

  window.onclick = function(event) {
    if(event.target == modal) {
      span.onclick();
    }
  }

  setTimeout(span.onclick, 3000);
}
