<?php
//Ühenduse loomine andmebaasiga
require_once("../../config.php");
$database = "if21_karlvask";

function read_all_person_for_select($person_selected){
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
	echo $connection->error;
	
	$connection->set_charset("utf8");
	
	$state = $connection->prepare("SELECT * FROM person");
	echo $connection->error;
	
	$state->bind_result($id_from_db, $first_name_db, $last_name_db, $birth_date_db);
	
	$state->execute();
	
	$option_html = null;
	
	while($state->fetch()){
		$option_html .= '<option value="'.$id_from_db.'"';
		if($id_from_db == $person_selected){
			$option_html .= '<option value="'.$id_from_db.'" selected';
		}
		$option_html .=">".$first_name_db." ".$last_name_db."(".$birth_date_db.")"."</option> <ln>";
	}
	
	$state->close();
	$connection->close();
	echo "test";
	return $option_html;
}


function read_all_movie_for_select($movie_selected){
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
	echo $connection->error;
	
	$connection->set_charset("utf8");
	
	$state = $connection->prepare("SELECT id, title, production_year FROM movie");
	echo $connection->error;
	
	$state->bind_result($id_from_db, $title_db, $production_year_db);
	
	$state->execute();
	
	$option_html = null;
	
	while($state->fetch()){
		$option_html .= '<option value="'.$id_from_db.'"';
		if($id_from_db == $movie_selected){
			$option_html .= '<option value="'.$id_from_db.'" selected';
		}
		$option_html .=">".$title_db."(".$production_year_db.")"."</option> <ln>";
	}
	
	$state->close();
	$connection->close();
	echo "test";
	return $option_html;
}



function read_all_position_for_select($position_selected){
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
	echo $connection->error;
	
	$connection->set_charset("utf8");
	
	$state = $connection->prepare("SELECT id, position_name FROM position");
	echo $connection->error;
	
	$state->bind_result($id_from_db, $position_from_db);

	$state->execute();
	
	$option_html = null;
	
	while($state->fetch()){
		$option_html .= '<option value="'.$id_from_db.'"';
		if($id_from_db == $position_selected){
			$option_html .= '<option value="'.$id_from_db.'" selected';
		}
		$option_html .=">".$position_from_db."</option> <ln>";
	}
	
	$state->close();
	$connection->close();
	return $option_html;
}



function store_person_movie_relation($movie_selected, $person_selected, $position_selected){
	$relation_store_notice = null;
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
	echo $connection->error;
	
	$connection->set_charset("utf8");
	
	$state = $connection->prepare("SELECT id FROM person_in_movie where person_id = ? and movie_id = ? and position_id = ? and role = ?");
	
	$state->bind_param("iiis", $person_selected, $movie_selected, $position_selected, $role);
	
	$state->bind_result($id_from_db);
	
	$state->execute();
	
	if($state->fetch()){
		$relation_store_notice = "Seos on juba olemas!";
	}
	else{
		$state->close();
		$state = $connection->prepare("INSERT INTO person_in_movie (person_id, movie_id, position_id, role) VALUES (?, ?, ?, ?)");
		$state->bind_param("iiis", $person_selected, $movie_selected, $position_selected, $role);
		if($state->execute()){
			$relation_store_notice="Uus seos on salvestatud!";
		}
		else{
			$relation_store_notice="Uue seose salvestamisel tekkis viga!".$state->error;
		}
	}
	
	$state->close();
	$connection->close();
	return $relation_store_notice;
}

function show_latest_public_photo(){
	$photo_html = null;
	$privacy = 1;
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
	echo $connection->error;
	
	$connection->set_charset("utf8");
	
	$state = $connection->prepare("SELECT filename, alttext FROM vprg_photos WHERE id = (SELECT MAX(id) FROM vprg_photos WHERE privacy = ? AND deleted IS NULL)");
	echo  $connection->error;
	$state->bind_param("i",$privacy);
	$state->bind_result($filename_from_db, $alt_text_from_db);
	$state->execute();
	if($state->fetch()){
		//<img src=kataloog/fail alt="tekst">
		$photo_html = '<img src="'.$GLOBALS["upload_photo_normal_dir"].$filename_from_db . '" alt ="';
		if(empty($alt_text_from_db)){
			$photo_html .= "Üleslaetud foto";
		}
		else{
			$photo_html .= $alt_text_from_db;
		}
		$photo_html .= '">'."\n";
	}
	else{
		$photo_html = "<p>Avalikke pilte ei ole üles laetud!</p>";
	}
	$state->close();
	$connection->close();
	return $photo_html;
}

function read_public_photo_thumbs($privacy){
	$photo_html = null;
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
	echo $connection->error;
	
	$connection->set_charset("utf8");
	
	$state = $connection->prepare("SELECT filename, alttext FROM vprg_photos WHERE privacy >= ? AND deleted IS NULL ORDER BY id DESC LIMIT 2");
	echo  $connection->error;
	$state->bind_param("i", $privacy);
	$state->bind_result($filename_from_db, $alt_text_from_db);
	$state->execute();
	while($state->fetch()){
		//<img src=kataloog/fail alt="tekst">
		$photo_html .= '<div class="thumbgallery">'."\n";
		$photo_html .= '<img src="'.$GLOBALS["upload_photo_normal_dir"].$filename_from_db . '" alt ="';
		if(empty($alt_text_from_db)){
			$photo_html .= "Üleslaetud foto";
		}
		else{
			$photo_html .= $alt_text_from_db;
		}
		$photo_html .= '" class="thumbs">'."\n";
		$photo_html .= '</div>'."\n";
	}
	if(empty($photo_html)){
		$photo_html = "<p>Avalikke pilte ei ole üles laetud!</p>";
	}
	
	$state->close();
	$connection->close();
	return $photo_html;
}


?>
