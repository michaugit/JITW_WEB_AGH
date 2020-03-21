
	<?php
	//  echo 'Przykładowy tekst'; 

	 function witaj($Zmienna) {
		if($Zmienna=='Michał'){
 			return 'Cześć ' . $Zmienna . '!';}
		else {
			wypisz();
			return 'Brak dostępu'.PHP_EOL;}

	 }

	 function wypisz() {
		 for($i=1;$i<=$_GET['Name'];$i++){
			 echo $i;
			}
		}

		print_r(witaj($_GET['Name']));
		
		


	 ?>
