<?php
session_write_close();
// Jeżeli request zostanie zamnięty przez przeglądarke to kończymy wykonywanie skryptu
ignore_user_abort(false);
// Ustawiamy limit czasu dla wykonania na 0,
set_time_limit(0);

// Pobieramy czas ostatniej modyfikacji pliku
// Jeżeli czas modyfikacji się zmieni podczas wykonywania skryptu
// To znaczy, że doszła nowa wiadomość i trzeba ją zwrócić hehe
$file_path = realpath('./messages.txt');
$file_modification_time = filemtime($file_path);
$file_modification_time_current = $file_modification_time;

// Porównujemy oryginalny czas modyfikacji z tym pobieranym, parametr GET 'fetch', pozwala ominąć pollowanie i czekanie
// i od razu dostać historie wiadomości
while ($file_modification_time == $file_modification_time_current && !isset($_GET['fetch'])) {
  clearstatcache();
  $file_modification_time_current = filemtime($file_path);
  sleep(1);
}

// Jeżeli pętla się skończyła
$messages = '';
$pointer = fopen($file_path, 'r');

// semafor
if (flock($pointer, LOCK_SH)) {
  // Wczytujemy wszystkie wiadomości
  $messages = fread($pointer, filesize($file_path));
  // Zwalniamy locka
  flock($pointer, LOCK_UN);
}

// Zamknięcie wskaźnika
fclose($pointer);

// Zwracamy wiadomości
echo $messages;

?>