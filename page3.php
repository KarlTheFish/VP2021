<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
    require("fnc_header.php");
    if(!isset($_SESSION["user_id"])){
	header("Location: page.php");
    }

$author_name = "Karl"; #PHP lause peab löppema semikooloniga
$film_html = null;

require_once("../../config.php"); //PHP käsk, millega saab teisi PHP faile nöuda
require_once("fun_films.php");

films_from_database();
$film_html = films_from_database();

?>

	<h1><center><img src="banana.gif" alt="tantsiv banaan" width=100></img> <?php echo $author_name;?>i veebileht <img src="banana.gif" alt="tantsiv banaan" width=100></img></center></h1>
	<h2><center>Eesti filmid</center></h2>
	
<?php echo $film_html;

?>

</body>
<?php require("fnc_footer.php"); ?>
</html>
