<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- <link rel="stylesheet" media="screen" href="blog_style.css" type="text/css" /> -->
	<?php include('includestyle.php');?>
	<title>Dodaj nowy komentarz</title>
</head>
<body onload="wyswietlListeStyli(); sprawdzCookies()">
	<div id="Tytuł">
		<h1> Michał Blogs </h1>
	</div>	
	
	<?php include 'menu.php'; ?>
	<div id="Spis_treści">
		
	<form action='koment.php'>
	<input type="hidden" name="postfilename" value="<?php echo $_GET['postfilename'];?>" />
	<input type="hidden" name="nazwa" value="<?php echo $_GET['nazwa'];?>" />
    <b>Typ komentarza:</b><br/>
    <select name="reakcja">
        <option value="pozytywny">Pozytywny</option>
        <option value="neutralny">Neutralny</option>
        <option value="negatywny">Negatywny</option>
    </select><br/>
    <b>Treść komentarza:</b><br/>
    <textarea name="komentarz" placeholder="Wpisz komentarz" cols="30" rows="10"></textarea><br/>
    <b>Nazwa uzytkownika:</b><br/>
    <input type="text" placeholder="Wpisz swój nick" name="nick" required="required">  </input><br /><br />
	<input type='submit'value="Wyślij">
	<input type="reset" value="Wyczyść" /> <br />
</form>
	
	</div>
</body>
</html>
