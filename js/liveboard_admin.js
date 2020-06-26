$("#chat-container").on("keydown", function(event) {
  if(event.keyCode == 13) {
    sendNotification(document.getElementById("sendNotification"));
  }
});

function sendNotification(item) {
  let parentElement = item.parentElement;

  let username = parentElement.children[2].value;
  let text = parentElement.children[3].value;

  if(username == "" || text == "") return;

  $.ajax({url: "liveboard_admin.php?action=sendNotification&username=" + username + "&text=" + text, error: function(xhr, response, error) {
    console.log("Error!");
  }});

  parentElement.children[3].value = '';
}

function addStatusEntry(text) {
  let newEntry = document.createElement("h2");
  newEntry.innerText = text;
  newEntry.classList.add("content-box-text-h2");
  $("#status-content").append(newEntry);
}

function clearStatus() {
  $("#status-content").empty();
}

function receiveStatuses() {
  $.ajax({url: "liveboard_admin.php?action=getStatus", success: function(response) {
    clearStatus();
    clearSpeakingWishes();
    clearUserEntries();

    let statuses = JSON.parse(response);

    statuses.forEach((status, index) => {
      addUserEntry(status.username + " - " + status.number + " - " + status.destination + " - " + status.delay + " min");
      addStatusEntry(status.number + " - " + status.destination + " - " + status.status);

      if(status.status !== "Kein Sprechwunsch") {
        addSpeakingWish(status.username + " - " + status.status);
      }
    });
  }, error: function(xhr, response, error) {
    console.log("Error!");
  }});
}

function addSpeakingWish(text) {
  let newEntry = document.createElement("h2");
  newEntry.innerText = text;
  newEntry.classList.add("content-box-text-h2");
  $("#speaking-wishes-content").append(newEntry);
}

function clearSpeakingWishes() {
  $("#speaking-wishes-content").empty();
}

function addUserEntry(text) {
  let newEntry = document.createElement("h2");
  newEntry.innerText = text;
  newEntry.classList.add("content-box-text-h2");
  $("#user-overview-content").append(newEntry);
}

function clearUserEntries() {
  $("#user-overview-content").empty();
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
  $.ajax({url: "liveboard_admin.php?getChat", success: function(response) {
    clearChat();

    let json = JSON.parse(response);
    let jsonMessages = json.messages;

    if(jsonMessages.length == 0) return;

    jsonMessages.forEach((message, index) => {
      if(message.sender == "Leitstelle") {
        addChatEntry("-> Wagen " + message.target + ": " + message.text);
      } else {
        addChatEntry("<- Wagen " + message.sender + ": " + message.text);
      }
    });

    //new Audio("Audiodatei.mp3").play();
  }, error: function(xhr, response, error) {
    console.log("Error!");
  }});
}

setInterval(receiveNotifications, 1000);

setInterval(receiveStatuses, 1000);
