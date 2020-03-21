// Wyszukanie elementów
var pollXhr = null;
var checkbox = document.querySelector('#chat__activate');
var chatRoom = document.querySelector('.chat__room');
var usernameInput = document.querySelector('#username');
var messageInput = document.querySelector('#message');
var sendButton = document.querySelector('.chat__send');
var chatForm = document.querySelector('.chat__form');

checkbox.addEventListener('change', onCheckboxChange);
chatForm.addEventListener('submit', onMessageSubmit)

// ON / OFF checkbox
function onCheckboxChange (event) {
  setChatActive(event.target.checked);
}

// Zmieniamy elementy na włączone / wyłączone
// Jeżeli włączamy to pobieramy z serwera aktualny chat (bez czekania)
// oraz uruchamiamy long-polling
function setChatActive (enabled) {
  usernameInput.disabled = !enabled;
  messageInput.disabled = !enabled;
  sendButton.disabled = !enabled;

  if (enabled) {
    fetchCurrentMessages();
    pollMessages();
  } else {
    // Odłączamy się od chatu
    // Kasujemy wiadomości i zamykamy polling
    setChatText('');
    pollXhr.abort();
  }
}

// Wysyła zapytanie do messages.php ale z parametrem ?fetch=true
// Parametr powoduje że skrypt PHP nie będzie wykonywał nieskończonej pętli
// czekając na aktualizację pliku z chatem, tylko pobierze wszystkie wiadomości
// i od razu nam je zwróci
function fetchCurrentMessages () {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'messages.php?fetch=true');
  xhr.send();

  // Wykonuje się po odebraniu odpowiedzi od serwera
  xhr.onload = function () {
    if (xhr.status != 200) {
      alert('Błąd ' + xhr.status + ': ' + xhr.statusText);
    } else {
      // Ustawiamy wiadomości w chacie na te zwrócone przez serwer
      setChatText(xhr.responseText);
    }
  };

  xhr.onerror = function () {
    alert('Błąd podczas wysyłania zapytania');
  };
}

function setChatText (messages) {
  chatRoom.value = messages;
}

function onMessageSubmit (event) {
  event.preventDefault();

  if (!usernameInput.value || !messageInput.value) {
    alert('Pola nazwa użytkownika i wiadomość nie mogą być puste!');
    return;
  }

  // FormData zbiera wszystkie inputy w formularzu z atrybutem name
  // i tworzy mape <nazwa: wartość>, którą możemy bezpośrednio przekazać
  // do XMLHttpRequest.
  var formData = new FormData(event.target);
  var xhr = new XMLHttpRequest();

  xhr.open('POST', 'send.php');
  xhr.send(formData);


  // Wiadomość wysłana przez autora odrazu pojawia się w jego okienku - nie czeka na odp serwera
  chatRoom.value += usernameInput.value + ': ' + messageInput.value;

  // Czyszczenie message boxa 
  messageInput.value = '';
}


function pollMessages () {
  pollXhr = new XMLHttpRequest();
  pollXhr.open('GET', 'messages.php');
  pollXhr.send();

  pollXhr.onload = function () {
    if (pollXhr.status != 200) {
      alert('Błąd ' + pollXhr.status + ': ' + pollXhr.statusText);
    } else {
      // Ustawiamy wiadomości w chatboxie
      setChatText(pollXhr.responseText);
      // Otwieramy połączenie ponownie
      pollMessages();
    }
  };

  pollXhr.onerror = function () {
    alert('Błąd podczas wysyłania zapytania');
    pollMessages();
  };
}