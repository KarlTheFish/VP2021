<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga

require_once("../../config.php"); //PHP käsk, millega saab teisi PHP faile nöuda
require_once("fun_films.php");

echo "Test 2";

$film_store_notice = null;

$title_input_error = null;
$year_input_error = null;
$duration_input_error = null;
$genre_input_error = null;
$studio_input_error = null;
$director_input_error = null;

$user_title_input = null;
$user_year_input = null;
$user_duration_input = 60;
$user_genre_input = null;
$user_studio_input = null;
$user_director_input = null;

if(isset($_POST["film_submit"])){
	if(!empty($_POST["title_input"])){
        $user_title_input = htmlspecialchars($_POST["title_input"]);
    }
    else{
        $film_store_notice = "Andmeid on puudu!";
        $title_input_error = "Sisestage filmi pealkiri!";
    }
    if(!empty($_POST["year_input"])){
        $user_year_input = htmlspecialchars($_POST["year_input"]);
    }
    else {
    $film_store_notice = "Andmeid on puudu!";
    $year_input_error = "Sisestage väljastamisaasta!";
    }
    if(!empty($_POST["duration_input"])){
        $user_duration_input = htmlspecialchars($_POST["duration_input"]);
        $user_duration_input = filter_var($user_duration_input, FILTER_VALIDATE_INT);
    }
    else{
        $film_store_notice = "Andmeid on puudu!";
        $duration_input_error = "Sisestage filmi kestus minutites!";
    }
    if(!empty($_POST["genre_input"])){
        $user_genre_input = htmlspecialchars($_POST["genre_input"]);
    }
    else{
        $film_store_notice = "Andmeid on puudu!";
        $genre_input_error = "Sisestage filmizanr!";
    }
    if(!empty($_POST["studio_input"])){
        $user_studio_input = htmlspecialchars($_POST["studio_input"]);
    }
    else{
        $film_store_notice = "Andmeid on puudu!";
        $studio_input_error = "Sisestage filmistuudio!";
    }
    if(!empty($_POST["director_input"])){
        $user_director_input = htmlspecialchars($_POST["director_input"]);
    }
    else{
    $film_store_notice = "Andmeid on puudu!";
    $director_input_error = "Sisestage filmi lavastaja!";
    }
    if(empty($title_input_error) and empty($year_input_error) and empty($duration_input_error) and empty($genre_input_error) and empty($studio_input_error) and empty($director_input_error)){
        $film_store_notice = store_film($_POST["title_input"],$_POST["year_input"],$_POST["duration_input"],$_POST["genre_input"],$_POST["studio_input"],$_POST["director_input"]);
    }
}    



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
   <form method="POST">
        <label for="title_input">Filmi pealkiri</label>
        <input type="text" name="title_input" id="title_input" placeholder="filmi pealkiri" value="<?php echo $user_title_input; ?>">
        <?php echo $title_input_error ?>
        <br>
        <label for="year_input">Valmimisaasta</label>
        <input type="number" name="year_input" id="year_input" min="1912" value="<?php echo $user_year_input; ?>">
        <?php echo $year_input_error ?>
        <br>
        <label for="duration_input">Kestus</label>
        <input type="number" name="duration_input" id="duration_input" min="1" value="<?php echo $user_duration_input; ?>" max="600">
        <?php echo $duration_input_error ?>
        <br>
        <label for="genre_input">Filmi žanr</label>
        <input type="text" name="genre_input" id="genre_input" placeholder="žanr" value="<?php echo $user_genre_input; ?>">
        <?php echo $genre_input_error ?>
        <br>
        <label for="studio_input">Filmi tootja</label>
        <input type="text" name="studio_input" id="studio_input" placeholder="filmi tootja" value="<?php echo $user_studio_input; ?>">
        <?php echo $studio_input_error ?>
        <br>
        <label for="director_input">Filmi režissöör</label>
        <input type="text" name="director_input" id="director_input" placeholder="filmi režissöör" value="<?php echo $user_director_input; ?>">
        <?php echo $director_input_error ?>
        <br>
        <input type="submit" name="film_submit" value="Salvesta">
    </form>
    <span><?php echo $film_store_notice; ?></span>

</body>
<footer>
	<hr>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
	<hr>
</footer>
</html>
