<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!-- <script type="text/javascript" src="chat.js"></script>	 -->
	<?php	include 'includestyle.php'; ?>
	<title>Chat</title>
</head>
<body onload="wyswietlListeStyli(); sprawdzCookies()">
<div id="Tytuł">
		<h1> Michał Blogs </h1>
</div>
  <?php include 'menu.php'; ?>
  
  <div class="form chat">
    <div class="chat__group">
	<br/>
      <input type="checkbox" id="chat__activate">
      <label for="chat__activate">Aktywuj chat</label>
    </div>
    <div class="form__group">
      <textarea class="chat__room" disabled></textarea>
    </div>
    <form class="chat__form">
      <div class="form__group">
        <label for="username">Nazwa użytkownika:</label>
        <input id="username" name="username" type="text" disabled>
      </div>
      <div class="form__group">
        <label for="message">Wiadomość:</label>
        <textarea id="message" name="message" class="chat__message" disabled></textarea>
      </div>
      <div class="form__group">
        <button role="submit" class="chat__send" disabled>Wyślij</button>
		<br/>
		<br/>
      </div>
    </form>
  </div>

  <script src="./chat.js"></script>
</body>
</html>



