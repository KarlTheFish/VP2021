<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga

require_once("fun_movie.php"); 

$person_photo_store_notice = null;
$relation_store_notice = null;
$person_selected = null;
$role = null;
$person_photo_dir = "person_photo/";
$file_name = null;

if(isset($_POST["relation_submit"])){
	if(isset($_POST["person_select"]) and !empty($_POST["person_select"])){
		$person_selected = filter_var($_POST["person_select"],FILTER_VALIDATE_INT);
	}
	if(empty($person_selected)){
		$relation_store_notice .= "Isikut pole valitud! ";
	}
	if(isset($_POST["position_select"]) and !empty($_POST["position_select"])){
		$position_selected = filter_var($_POST["position_select"],FILTER_VALIDATE_INT);
	}
	if(empty($position_selected)){
		$relation_store_notice .= "Rolli pole valitud! ";
	}
	if(isset($_POST["movie_select"]) and !empty($_POST["movie_select"])){
		$movie_selected = filter_var($_POST["movie_select"],FILTER_VALIDATE_INT);
	}
	if(empty($movie_selected)){
		$relation_store_notice .= "Filmi pole valitud! ";
	}
	
	if(empty($relation_store_notice)){
		$relation_store_notice = store_person_movie_relation($person_selected, $movie_selected, $position_selected);
	}
}

if(isset($_POST["person_photo_submit"])){
	$image_check = getimagesize($_FILES["person_photo"]["tmp_name"]);
	 if($image_check !== false){
            if($image_check["mime"] == "image/jpeg"){
                $file_type = "jpg";
            }
            if($image_check["mime"] == "image/png"){
                $file_type = "png";
            }
            if($image_check["mime"] == "image/gif"){
                $file_type = "gif";
            }
		
	$time_stamp = microtime(1) * 10000;
	
	 $file_name = "person_".$_POST["person_select"]."_".$time_stamp.".".$file_type;
	
	move_uploaded_file($_FILES["person_photo"]["tmp_name"], $person_photo_dir.$file_name);
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
	<h2><center>Filmiseoste loomine</center></h2>
	<h3><center>Film, isik ja amet</center></h3>
   <form method="POST">
       <label for="person_select">Isik:</label>
	   <select name="person_select" id="person_select">
	   <option value="" selected disabled>Isik</option>
			<?php echo read_all_person_for_select($person_selected);
			?>
	   </select>
	   
	   <label for="position_select">Roll:</label>
	   <select name="position_select" id="position_select">
			<option value="" selected disabled>Roll</option>
			<?php echo read_all_position_for_select($position_selected);
			?>
	   </select>
	   
	    <label for="movie_select">Film:</label>
	   <select name="movie_select" id="movie_select">
			<option value="" selected disabled>Film</option>
			<?php echo read_all_movie_for_select($movie_selected);
			?>
	   </select>
	   <br>
        <input type="submit" name="relation_submit" value="Salvesta">
    </form>
    <span><?php echo $relation_store_notice; ?></span>
	
	<hr>
	<h3>Isiku foto lisamine</h3>
	<form method="POST" enctype="multipart/form-data">
		<label for="person_photo_select">Isik:</label>
		<select name="person_select" id="person_photo_select">
			<option value="" selected disabled>Isik</option>
			<?php echo read_all_person_for_select($person_photo_selected);
			?>
	   </select>
	   <input type="file" name="person_photo" id="person_photo">
	   <input type="submit" name="person_photo_submit" id="person_photo_submit">
	</form>
	<span><?php echo $person_photo_store_notice ?></span>
</body>
<footer>
	<hr>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
	<hr>
</footer>
</html>
