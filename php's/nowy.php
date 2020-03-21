<?php
	define('MUTEX_KEY', 123456); # the key to access you unique semaphore
	sem_get( MUTEX_KEY, 1, 0666, 1 );
	
	sem_acquire( ($resource = sem_get( MUTEX_KEY )) );
	$nazwa_bloga = $_POST['nazwa_bloga'];
	$nazwa_uzytkownika = $_POST['nazwa_uzytkownika'];
	$haslo = $_POST['haslo'];
	$opis = $_POST['opis'];
	
	if(!file_exists("blogs/" . $nazwa_bloga)){	
		mkdir ("blogs/" . $nazwa_bloga,0755);
		$W = fopen("blogs/$nazwa_bloga/info",'w');
		fwrite($W, $nazwa_uzytkownika . "\n" . md5($haslo) . "\n" . $opis);
		fclose($W);		
		echo "Utworzono nowy blog.<br />";
		header("refresh:3;url=post.php");
	}
	else{
		echo "Blog o tej nazwie już istnieje! <br />";
		echo "Nie może istnieć więcej niż jeden blog o tej samej nazwie!";
		header("refresh:3;url=tworzenie.php");
	}
	
	sem_release( $resource );
	
?>
