<?php
$database="if21_karlvask";

	function sign_up($firstname,$surname,$birth_date,$gender,$email,$password) {
		$notice = null;
		$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]); //sulgudes: server, kasutaja, parool, andmebaas

		//Määrame õige kooditabeli

		$connection->set_charset("utf8");
		
		//SQL käsu ettevalmistamine - kirjutame käsu
		
		$state = $connection->prepare("SELECT id FROM vprg_users WHERE email = ?");
		$state->bind_param("s", $email);
		echo $email;
		$state->bind_result($id_from_db);
		$state->execute();
		if($state->fetch()){
            $notice = "Sellise e-mailiga kasutaja juba eksisteerib!";
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
        $state = $conn->prepare("SELECT password, id, firstname, lastname FROM vprg_users WHERE email = ?");
        echo $conn->error;
        $state->bind_param("s", $email);
        $state->bind_result($password_from_db, $id_from_db, $firstname_from_db, $lastname_from_db);
        $state->execute();
        if($state->fetch()){
            //kasutaja on olemas, parool tuli ...
            if(password_verify($password, $password_from_db)){
                //parool õige, oleme sees!
                $_SESSION["user_id"] = $id_from_db;
                $_SESSION["user_name"] = $firstname_from_db ." ". $lastname_from_db;
                $state->close();
                header("Location: home.php");
                $state = $conn->prepare("SELECT id FROM vprg_userprofiles WHERE userid = ?");
                $state->bind_param("i", $_SESSION["user_id"]);
                $state->bind_result($profile_id);
                $state->execute();
                if($state->fetch()){
                    $state->close();
                    $state = $conn->prepare("SELECT bgcolor, txtcolor FROM vprg_userprofiles WHERE userid = ?");
                    $state->bind_param("i", $_SESSION["user_id"]);
                    $state->bind_result($bgcolor_from_db, $txtcolor_from_db);
                    $state->execute();
                    if((!isset($bgcolor_from_db)) or (!isset($txtcolor_from_db))){
                        $state->close();
                        $defbg = "ffffff";
                        $deftxt = "000000";
                        $state = $conn->prepare("UPDATE vprg_userprofiles SET bgcolor = ?, txtcolor = ? WHERE userid = ?");
                        $state->bind_param("ssi", $defbg, $deftxt, $_SESSION["user_id"]);
                        $state->execute();
                        }
                }
                else{
                    $state->close();
                    $defbg = "ffffff";
                    $deftxt = "000000";
                    $state = $conn->prepare("INSERT INTO vprg_userprofiles (userid, bgcolor, txtcolor) VALUES (?, ?, ?)");
                    $state->bind_param("iss", $_SESSION["user_id"], $defbg, $deftxt);
                    $state->execute();
                }
                exit();
            } else {
                $notice = "Kasutajatunnus või salasõna oli vale!";
            }
        } else {
            $notice = "Kasutajatunnus või salasõna oli vale!";
        }
        
        $state->close();
        $conn->close();
        return $notice;
    }
    
 function profile($userid, $userdesc, $bgcolor, $txtcolor){
    $notice = null;
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
        $state= $conn->prepare("SELECT bgcolor, txtcolor FROM vprg_userprofiles WHERE userid = ?");
        $state->bind_param("i", $userid);
        $state->bind_result($bg_from_db, $txt_from_db);
        $state->execute();
        if(!($state->fetch())){
            $state->close();
            $state = $conn->prepare("INSERT INTO vprg_userprofiles (userid, description, bgcolor, txtcolor) VALUES (?, ?, ?, ?) ");
            $state->bind_param("is", $userid, $userdesc, $bgcolor, $txtcolor);
            $state->execute();
        }
        else{
            
        }
        
        $state->close();
        $conn->close();
 }

?>
