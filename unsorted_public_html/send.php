<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_POST['username'];
$message = $_POST['message'];

if (empty($username) || empty($message)) {
  echo 'Nie podano nazwy użytkownika lub wiadomości!';
  return;
}

$file_path = realpath('./messages.txt');
$pointer = fopen($file_path, 'r+');

// Ilość komunikatów przechowywana na serwerze musi być ograniczona.
$max_messages = 25;

// semafor
if (flock($pointer, LOCK_SH)) {
  // Wczytujemy wszystkie wiadomości do tablicy (każda wiadomość jest w jednej linii)
  $messages = explode(PHP_EOL, fread($pointer, filesize($file_path)));
  // Dodajemy nową wiadomość <user>: <message>
  $messages[] = $username . ': ' . remove_new_lines($message);
  $messages = array_filter($messages, 'strlen');
  // Sprawdzamy czy nowa liczba wiadomości nie przekracza limitu
  $messages_count = count($messages);

  // Jeżeli przekracza limit to usuwamy wiadomości z początku tablicy
  if ($messages_count > $max_messages) {
    $messages = array_slice($messages, $messages_count - $max_messages);
  }
  // Przywrócenie wskaźnika na sam początek
  rewind($pointer);
  // Usuwamy wszystko z pliku
  ftruncate($pointer, 0);
  
  // Zapisujemy każdą wiadomość w nowej linii
  foreach ($messages as $message) {
    fwrite($pointer, $message . PHP_EOL);
  }

  flock($pointer, LOCK_UN);
}

fclose($pointer);

// wiadomosc ze wszytko ok
echo 'OK';

function remove_new_lines($text) {
  return str_replace(["\r\n","\r","\n"], ' ', $text);
}

?>