<?php
	function name($directory){
		$filename = "";
		$year = substr($_POST["date"], 0, 4);
		$filename = $filename.$year;
		$month = substr($_POST["date"], 5, 2);
		$filename = $filename.$month;
		$day = substr($_POST["date"], 8, 2);
		$filename = $filename.$day;
		$hour = substr($_POST["time"], 0, 2);
		$filename = $filename.$hour;
		$minute = substr($_POST["time"], 3, 2);
		$filename = $filename.$minute;
		$seconds = date('s');
		$filename = $filename.$seconds;
		for ($i = 0; $i < 100 ; $i++) {
			if ($i < 10)
				$number = "0" . strval($i);
			else
				$number = strval($i);
			if (!file_exists($directory . "/" . $filename . $number)) {
				break;
			}
		}
		$filename  = $filename.$number;
		
		return $filename;
	}	
	
	$semafor = fopen("semafor1", "r+");
	if (flock($semafor, LOCK_EX)){
		$A = $_POST['nazwa_uzytkownika'];
		$B = md5($_POST['haslo']);
		$C = $_POST['post'];
		$blogs = scandir("blogs/");
		foreach($blogs as $path) {
			if($path != "." && $path != ".." and is_dir("blogs/" . $path)) {
				if($file = fopen("blogs/".$path."/info", 'r')) {
					$line1 = trim(fgets($file));
					$line2 = trim(fgets($file));
					$line3 = trim(fgets($file));
					if ($line1 == $A){
						$pathb = $path;
						if ($line2 == $B) {
						$name =  name("blogs/$path");
						$postname = "blogs/$path/$name";
						$W = fopen($postname,'w');
						fwrite($W,$C);
						fclose($W);
						$counter = 0;
						foreach($_FILES as $uploadedFile) {
							if ($uploadedFile['error'] === 0) {
								$info = pathinfo($uploadedFile['name']);
								$uploadedName = $name.$counter.'.'.$info['extension'];
								$targetLocation = "blogs/$path/$uploadedName";
								move_uploaded_file($uploadedFile['tmp_name'], $targetLocation);
								$counter += 1;
							}                    
						}
						echo "Utworzono nowy wpis.<br />";
						}
						else{						
							echo "Błędne hasło.<br />";
							header("refresh:3;url=post.php");
							exit(2);
						}
					}
						
				}
			}
		}		
		flock($semafor, LOCK_UN);
	}
	else{
		echo "Race condition error";
		exit(-1);
}
	fclose($semafor);
	header("refresh:3;url=blog.php?nazwa=".$pathb);

?>
