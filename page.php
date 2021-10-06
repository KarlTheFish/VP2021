<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga
$time_hours = date("H");
$time_minutes = date("i");
$weekday_now = date("N");
$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];

if($weekday_now <= 5) #PHPs "if" lause tingimus, mida kontrollitakse, sulgudes
	{ $day_cat = "koolipäev"; #PHPs loogeliste sulgude sees see, mis juhtub tingimuse täitmisel
	if($time_hours <= 8)
		{$time_cat = "tuduaeg";
		}
	 elseif($time_hours >= 8 and $time_hours <= 16)
	 	{$time_cat = "tundide aeg";
		}
	 else
	 {$time_cat = "vaba aeg";
	}
}
else
	{$day_cat = "puhkepäev";
	if($time_hours <= 10 and $time_hours >= 1)
		{$time_cat = "tuduaeg";
		}
 	else
		{$time_cat = "vaba aeg";
		}
	}
?>
<!DOCTYPE html> <!-- Vajalik HTML osa alguses -->
<html lang="et">
<head> <!-- Veebilehe kohta käiv info, mida näha ei ole -->
	<meta charset="utf-8"> <!-- meta kirjeldab andmeid; charset näitab, mis sümbolitabelit kasutatakse -->
	<title><?php echo $author_name;?>i leht kell <?php echo $time_hours. ":". $time_minutes; ?></title>
	<style>
		body {
  				animation: 100000ms ease-in-out infinite color-change; 
			}

			@keyframes color-change {
			  0% {
				background-color: black;
				color: white;
			  }
			  25% {
				background-color: gold;
				color: black;
			  }
			  50% {
				background-color: black;
				color: white;
			  }
			  75% {
				background-color: red;
				color: black;
			  }
			  100% {
				background-color: black;
				color: white;
			  }
			}

	</style>
</head>
<body><!-- Veebilehe nähtav sisu -->
	<h1><center><img src="banana.gif" alt="tantsiv banaan" width=100></img> <?php echo $author_name;?>i veebileht <img src="banana.gif" alt="tantsiv banaan" width=100></img></center></h1>
	<h2><center>Graphic design is my passion</center></h2>
	<p><center><?php echo "Kell on ".$time_hours.":".$time_minutes.", on ". $time_cat.". Täna on ". $weekday_names_et[$weekday_now - 1].", ".$day_cat;?></center></p> <!-- PHPs on + asemel . -->
	<!-- hitwebcounter Code START -->
<a href="https://www.hitwebcounter.com" target="_blank">
<img src="https://hitwebcounter.com/counter/counter.php?page=7862612&style=0009&nbdigits=5&type=page&initCount=0" title="Free Counter" Alt="web counter"   border="0" /></a>                                    
	<p><b>See on minu veebileht.</b></p>
	<img src="haikyuu.jpg" alt="Haikyuu poster" width="500"></img>
	<img src="monster.gif" alt="Monsteri logo gif"></img>
<p>Minu top 10 Monsteri maitset: <br>
	1. Monster Mule <br> 2. Pacific punch <br> 3. Ultra fiesta mango <br> 4. Ultra violet <br> 5. Monster Ripper <br> 6. Monarch <br> 7. Ultra black</p>
	<?php echo $photo_html; ?>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
</body>
</html>