<?php

$plik = fopen('slownik.txt','r');

$c = $_GET['Name'];

while (!feof($plik)) {
    $s = trim(fgets($plik));
    
	if(strlen($c) == strlen($s)){
	    $ok =1;
	    for($i=0;$i<strlen($s);$i++){
		    if($s[i] !=$c[i] && $c[i] != '_')
			    {$ok = 0;}
    	}
	    if($ok == 1)
	        echo $s . '<br/>';
	}	
}

fclose($plik);



?>
