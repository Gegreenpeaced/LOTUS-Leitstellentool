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

    jsonMessages.forEach((message, index) => {
      addChatEntry("Wagen " + message.username + ": " + message.text);
    });

    //new Audio("Audiodatei.mp3").play();
  }, error: function(xhr, response, error) {
    console.log("Error!");
  }});
}

setInterval(receiveNotifications, 1000);
