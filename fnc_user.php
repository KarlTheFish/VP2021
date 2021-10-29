<?php
$database="if21_karlvask";

	function sign_up($firstname,$surname,$email,$gender,$birth_date,$password) {
		$notice = null;
		$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]); //sulgudes: server, kasutaja, parool, andmebaas

		//Määrame õige kooditabeli

		$connection->set_charset("utf8");
		
		echo "test 7";

		//SQL käsu ettevalmistamine - kirjutame käsu
		
		$state = $connection->prepare("SELECT id FROM vprg_users WHERE email = ?");
		$state->bind_param("s", $email);
		$state->bind_result($id_from_db);
		$state->execute();
		
		if($state->fetch()){
            $notice = "Sellise e-mailiga kasutaja juba eksisteerib!";
            echo "email olemas";
		}
		
        else{
            $state->close();
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
        }
		
		$state->close();
		$connection->close();
		return $notice;
		
	}
	
	//Sisselogimine
	
	function sign_in($email, $password){
        $notice = null;
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
        $stmt = $conn->prepare("SELECT password FROM vprg_users WHERE email = ?");
        echo $conn->error;
        $stmt->bind_param("s", $email);
        $stmt->bind_result($password_from_db);
        $stmt->execute();
        if($stmt->fetch()){
            //kasutaja on olemas, parool tuli ...
            if(password_verify($password, $password_from_db)){
                //parool õige, oleme sees!
                $stmt->close();
                $conn->close();
                header("Location: home.php");
                exit();
            } else {
                $notice = "Kasutajatunnus või salasõna oli vale!";
            }
        } else {
            $notice = "Kasutajatunnus või salasõna oli vale!";
        }
        
        $stmt->close();
        $conn->close();
        return $notice;
    }

?>
