<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tworzenie bloga</title>
	<!-- <link rel="stylesheet" media="screen" href="blog_style.css" type="text/css" /> -->
	<?php	include 'includestyle.php'; ?>
</head>
<body onload="wyswietlListeStyli(); sprawdzCookies()">
	<div id="Tytuł">
		<h1> Michał Blogs </h1>
	</div>

	<?php include 'menu.php'; ?>

	<div id="Spis_treści">
	
	<form action='nowy.php' method='POST'>
	<b>Nazwa bloga:</b><br />
	<input type='text' name='nazwa_bloga' placeholder = 'Podaj nazwę bloga.' required="required"> <br />
	<b>Nazwa użytkownika:</b><br />
	<input type='text' name='nazwa_uzytkownika' placeholder = 'Podaj nazwę użytkownika.' required="required"> <br />	
	<b>Hasło:</b><br />
	<input type='password' name='haslo' placeholder = 'Podaj hasło.' required="required"> <br />	
	<b>Opis bloga:</b> <br />
	<textarea name='opis' cols = 60 rows = 5 placeholder = 'Podaj opis bloga.' ></textarea> <br /><br />
	<input type='submit'value="Wyślij">
	<input type='reset' value="Wyczyść" /> <br />
	</form>

	</div>
</body>
</html>
