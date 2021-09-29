<?php
$database="if21_karlvask";

	function sign_up($firstname,$surname,$email,$gender,$birth_date,$password) {
		$notice = null;
		$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]); //sulgudes: server, kasutaja, parool, andmebaas

		//Määrame õige kooditabeli

		$connection->set_charset("utf8");

		//SQL käsu ettevalmistamine - kirjutame käsu

		$state = $connection->prepare("INSERT INTO vprg_users (firstname, lastname, email, birthdate, gender, password) values (?, ?, ?, ?, ?, ?)"); //sulgudesse SQL käsk
		
		echo $connection->error;
		
		//parooli krüpteerimine
		
		$option = ["cost" => 12];
		$password_hash = password_hash($password, PASSWORD_BCRYPT, $option); //sulgudes (mida krüpteeritakse, krüpteerimise algoritm, kui palju süsteem näeb vaeva et krüpteerida(max 12)
		
		$state->bind_param("sssiss", $firstname,$surname,$birth_date,$gender,$email,$password_hash);
		if($state->execute()){
			$notice = "Uus kasutaja edukalt loodud!";
		}
		else {
			$notice = "Uue kasutaja loomisel tekkis viga! ".$state->error;
		}
		
		$state->close();
		$connection->close();
		return $notice;
		
	}

?>