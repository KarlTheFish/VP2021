<?php
//Ühenduse loomine andmebaasiga
require_once("../../config.php");
$database = "if21_karlvask";

function films_from_database(){
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]); //sulgudes: server, kasutaja, parool, andmebaas
	echo $connection->error;

	//Määrame õige kooditabeli

	$connection->set_charset("utf8");

	//SQL käsu ettevalmistamine - kirjutame käsu

	$state = $connection->prepare("SELECT * FROM film"); //sulgudesse SQL käsk

	//Seome tulemused muutujatega, sulgudes muutuja nimi

	$state->bind_result($est_title_DB, $year_DB, $length_min_DB, $genre_DB, $studio_DB, $director_DB);

	//Käsu täitmiseks andmine - saadame käsu ära

	$state->execute();

	//Andmete võtmine
	$film_html = null;

	while($state->fetch()){
		
		//Andmete sobivasse vormi panemine
		$film_html .= "\n <h3>". $est_title_DB ."</h3> \n <ul> \n";
		$film_html .="<li>Valminud ".$year_DB."</li> \n";
		$film_html .="<li>Pikkus ".$length_min_DB." minutit</li> \n"; 
		$film_html .="<li>Zanr ".$genre_DB."</li> \n"; 
		$film_html .="<li>Tootja ".$studio_DB."</li> \n"; 
		$film_html .="<li>Rezissöör ".$director_DB."</li>\n";
		$film_html .="</ul>\n";

	}

	//Käsu sulgemine
	
	$state->close();
	
	//Andmebaasiühenduse sulgemine
	
	$connection->close();
	
	return $film_html;

}

function store_film($title_input,$year_input,$duration_input,$genre_input,$studio_input,$director_input){
	$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]); //sulgudes: server, kasutaja, parool, andmebaas
	echo $connection->error;
	$connection->set_charset("utf8");
	
	$state = $connection->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES (?,?,?,?,?,?)");
	echo $connection->error;
	
	$state->bind_param("siisss", $title_input, $year_input,$duration_input,$genre_input,$studio_input,$director_input); //Öeldakse, mis andmetüüpidega on tegu, peavad olema muutujad
	
	$success = null;
	if($state->execute()){
		$success = "Salvestamine õnnestus!";
	}
	else{
		$success = "Salvestamisel tekkis viga: ".$stmt->error;
	}
	$state->close();
	$connection->close();
	
	return $success;
}
?>
