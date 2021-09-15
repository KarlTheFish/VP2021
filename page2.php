<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<!-- 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 -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga
//juhusliku foto lisamine
$photo_dir = "pildid/";
#$photo_files = scandir($photo_dir); #failikataloogi skännimiseks scandir
$real_files = array_slice(scandir($photo_dir), 2);

//sõelume välja päris pildid
/* $photos = [];
$allowed_files = ["image/png","image/jpeg"];
foreach($real_files as $file_name) {
	$file_meta = getimagesize($photo_dir .$photo_files);
	if(isset($file_meta["mime"])) {
		if(in_array($file_info["mime"], $allowed_files)) {
			array_push($allowed_files, $file_name);
		}
	}
} */

$limit = count($real_files);
$pic_nr = mt_rand(0, $limit - 1);
$ran_picture = $real_files[$pic_nr];
$photo_html = '<img src="' .$photo_dir .$ran_picture . '" alt="Pilt" width="500">';
?>
<!DOCTYPE html> <!-- Vajalik HTML osa alguses -->
<html lang="et">
<head> <!-- Veebilehe kohta käiv info, mida näha ei ole -->
	<meta charset="utf-8"> <!-- meta kirjeldab andmeid; charset näitab, mis sümbolitabelit kasutatakse -->
	<title><?php echo $author_name;?>i leht</title>
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
<?php
$todays_opinion_html = null;
$user_opinion = null;
$todays_opinion = null;
$todays_opinion_error = null;
if(isset($_POST["submit_opinion"]))
{ if(!empty($_POST["user_opinion"]))
	{
	//echo "Päeva arvamus antud!";
	$todays_opinion_html = "<p>Tänane päev on ".$_POST["user_opinion"].".</p>";
	$todays_opinion = $_POST["user_opinion"];
	}
	else
	{
	$todays_opinion_error = "<p>Sisestage arvamus enda päevast!</p>";
	}
}
?>
	<h1><center><img src="banana.gif" alt="tantsiv banaan" width=100></img> <?php echo $author_name;?>i veebileht <img src="banana.gif" alt="tantsiv banaan" width=100></img></center></h1>
	<h2><center>Graphic design is my passion</center></h2>
	<?php $photo_list_html = "<ul>";
	for($i = 0; $i < $limit; $i++ ) //for funktsionis sulgudes (algväärtus, max väärtus, mitme vörra liidetakse)
	{$photo_list_html .= "<li>".$real_files[$i]."</li>";
	}
	$photo_list_html .= "</ul>";
	?>
	<?php echo $photo_html; 
	echo $photo_list_html;?>
	<?php $photo_select_html = "\n".'<select_name="photo_select">'."\n";
	for($i = 0; $i < $limit; $i++ ) //for funktsionis sulgudes (algväärtus, max väärtus, mitme vörra liidetakse)
	{$photo_select_html .= '<option_value="' .$i .'">' .$real_files[$i];
	}
	$photo_select_html .= "</ul>";
	?>
	<hr>
	<form method="POST">
	<?php echo $photo_select_html ?>
	</form>
	<form method="post"> <!-- vormielement -->
	<input type="text" name="user_opinion" placeholder="Mida arvate tänasest päevast?" value= <?php $user_opinion; ?> >
	<input type="submit" name="submit_opinion" value="Saada">
	<span><?php echo $todays_opinion_error; ?></span>
	</form>
	<?php echo $todays_opinion_html; ?>
	<hr>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
</body>
</html>