<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga
$film_html = null;

require_once("../../config.php"); //PHP käsk, millega saab teisi PHP faile nöuda
require_once("fun_films.php");

films_from_database();
$film_html = films_from_database();

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

	<h1><center><img src="banana.gif" alt="tantsiv banaan" width=100></img> <?php echo $author_name;?>i veebileht <img src="banana.gif" alt="tantsiv banaan" width=100></img></center></h1>
	<h2><center>Eesti filmid</center></h2>
	
<?php echo $film_html;

?>

<form method="post"> 
    <select name="test">
        <option value="0">Test1</option>
        <option value="1" selected>Test2</option>
    </select>
</form>

</body>
<footer>
	<hr>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
	<hr>
</footer>
</html>
