 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Znajdź blog</title>
	<!-- <link rel="stylesheet" media="screen" href="blog_style.css" type="text/css" /> -->
	<?php	include 'includestyle.php'; ?>
</head>
<body onload="wyswietlListeStyli(); sprawdzCookies()">
	<div id="Tytuł">
		<h1> Michał Blogs </h1>
	</div>	
	
	<?php include 'menu.php'; ?>
	<div id="Spis_treści">
	<?php
	if (count($_GET) == 0 || empty($_GET['nazwa'])){
		echo "<h1>Blogi</h1>";
		echo "<ul>";
		foreach(scandir("blogs/") as $blog){
			if ($blog[0]==".") continue;
			echo "<li> <a href='blog.php?nazwa=".$blog."' >".$blog."</a> </li>";
	}
	echo "</ul>";
	}
	else{
		$nazwa = $_GET["nazwa"];
		$path = "blogs/".$nazwa;
		//echo $path;
		if (!is_dir(($path))){
			echo "Blog nie istnieje";
			header("refresh:3;url=blog.php");
		}
		else{			
			echo "<h1>$nazwa</h1>";
			$fp = fopen("$path/info","r+");
			echo "<h4>Twórca: ".fgets($fp,255)."</h4>";
			fgets($fp,255);
			echo "<h5>Opis: ".fgets($fp, 255)."</h5>";
			echo "<h2>WPISY</h2>";
			$index = 1;
			$tmp = 0;
			foreach (scandir($path) as $var){
				if($var[0] == '.' || $var == "info"){continue;}
				if (is_dir($var)) continue; //katalog komentarzy
				if (pathinfo($var, PATHINFO_EXTENSION)==null){
					wpisy($var,$nazwa,$index);
					$index++;
					$tmp = 1;
				}
			}	
			if($tmp == 0)  echo "<h3>Brak wpisów!</h3>";
		}
	}
	
	
function wpisy($dir,$nazwa, $index){
	$path = "blogs/".$nazwa;
    echo "<h3>Wpis: $index</h3>";
	echo substr($dir, 0, 4)."-".substr($dir, 4, 2)."-".substr($dir, 6, 2)." ".substr($dir, 8, 2).":".substr($dir, 10, 2)."<br/>";
    $fp = fopen("blogs/".$nazwa.'/'.$dir,"r+");
    echo "Treść: ".fgets($fp,255)."<br />";
    zalaczniki($dir,$path);
	komentarze($dir,$path);
	echo "<a href='komentarze.php?nazwa=$nazwa&postfilename=$dir'> Dodaj komentarz do posta </a> </li>";
    
    fclose($fp);
}

function zalaczniki($dir,$path){	
    $index = 0;
	foreach (scandir($path) as $file){
			if (pathinfo($file)['filename'] == $dir.$index) {
				echo "<a href='$path/$dir$index.".pathinfo($file)['extension']."' target=\"_blank\"> Załącznik ".++$index." </a> </li><br/>";
			}
		}
		echo "<br/>";
}

function komentarze($dir,$path){
	$com = $path.'/'.$dir.".k";
    if (!file_exists($com)){
        echo "<h2>Brak komentarzy!</h2>";
    }
    else{
        echo "<h2>Komentarze:</h2>";
        $index = 1;
        foreach (scandir($com) as $kom){
            if($kom[0] == '.'){continue;}
            $fp = fopen($com.'/'.$kom,"r+");
            echo "<h3>Komentarz: ".$index++."</h3>";
            echo "Reakcja: ".fgets($fp,255)."<br/>";
            echo "Kiedy: ".fgets($fp,255)."<br/>";
            echo "Użytkownik: ".fgets($fp,255)."<br/>";
            echo "Treść: ".fgets($fp,1024)."<br/>";
            fclose($fp);
        }
    }
}

?>
	
	</div>
</body>
</html>