$("#chat-container").on("keydown", function(event) {
  if(event.keyCode == 13) {
    sendNotification(document.getElementById("sendNotification"));
  }
});

function sendNotification(item) {
  let parentElement = item.parentElement;

  let text = parentElement.children[2].value;

  if(text == "") return;

  $.ajax({url: "liveboard_user.php?action=sendNotification&text=" + text, error: function(xhr, response, error) {
    console.log("Error!");
  }});

  parentElement.children[2].value = '';
}

function sendStatus() {
  let item = document.getElementById("status-content");

  let destination = item.children[1].children[0].value;
  let status = item.children[2].children[0].value;
  let delaySelect = item.children[3].children[0];
  let delay = delaySelect[delaySelect.selectedIndex].id;

  $.ajax({url: "liveboard_user.php?action=sendStatus&destination=" + destination + "&status=" + status + "&delay=" + delay, error: function(xhr, response, error) {
    console.log("Error!");
  }});
}

function addChatEntry(text) {
  let newEntry = document.createElement("h2");
  newEntry.innerText = text;
  newEntry.classList.add("content-box-text-h2");
  $("#chat-content").append(newEntry);
}

function clearChat() {
  $("#chat-content").empty();
}

function receiveNotifications() {
  $.ajax({url: "liveboard_user.php?getChat", success: function(response) {
    clearChat();

    let json = JSON.parse(response);
    let jsonMessages = json.messages;

    if(jsonMessages.length == 0) return;

    jsonMessages.forEach((message, index) => {
      addChatEntry((message.sender == "Leitstelle" ? "Leitstelle" : "Du") + ": " + message.text);
    });

    //new Audio("Audiodatei.mp3").play();
  }, error: function(xhr, response, error) {
    console.log("Error!");
  }});
}

sendStatus();
setInterval(receiveNotifications, 1000);
