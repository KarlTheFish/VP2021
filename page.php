<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
require_once("../../config.php");
require_once("fnc_general.php");
require_once("fnc_user.php");

$id_from_db = null;

echo "test 1";

session_start();
    $_SESSION["user_id"] = $id_from_db;
    
    if(!isset($_SESSION["user_id"])){
    echo "sessioon alustatud";
// 	header("Location: page.php");
     }

$author_name = "Karl"; #PHP lause peab löppema semikooloniga
$time_hours = date("H");
$time_minutes = date("i");
$weekday_now = date("N");
$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];

$email = null;

if($weekday_now <= 5) #PHPs "if" lause tingimus, mida kontrollitakse, sulgudes
	{ $day_cat = "koolipäev"; #PHPs loogeliste sulgude sees see, mis juhtub tingimuse täitmisel
	if($time_hours <= 8)
		{$time_cat = "tuduaeg";
		}
	 elseif($time_hours >= 8 and $time_hours <= 16)
	 	{$time_cat = "tundide aeg";
		}
	 else
	 {$time_cat = "vaba aeg";
	}
}
else
	{$day_cat = "puhkepäev";
	if($time_hours <= 10 and $time_hours >= 1)
		{$time_cat = "tuduaeg";
		}
 	else
		{$time_cat = "vaba aeg";
		}
	}
	
//sisselogimine

$notice = null;
    if(isset($_POST["login_submit"])){
        if(isset($_POST["email_input"])) {
            $email = filter_var($_POST["email_input"], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
                $notice = "Palun sisestage õige emaili aadress!";
            }
            else{
                echo "Login!";
                $notice = sign_in($_POST["email_input"], $_POST["password_input"]);
            }
        }
    }
?>
<!DOCTYPE html> <!-- Vajalik HTML osa alguses -->
<html lang="et">
<head> <!-- Veebilehe kohta käiv info, mida näha ei ole -->
	<meta charset="utf-8"> <!-- meta kirjeldab andmeid; charset näitab, mis sümbolitabelit kasutatakse -->
	<title><?php echo $author_name;?>i leht kell <?php echo $time_hours. ":". $time_minutes; ?></title>
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
	<h2><center>Graphic design is my passion</center></h2>
	<p><center><?php echo "Kell on ".$time_hours.":".$time_minutes.", on ". $time_cat.". Täna on ". $weekday_names_et[$weekday_now - 1].", ".$day_cat;?></center></p> <!-- PHPs on + asemel . -->
	
	<hr>
	
	<!-- sisselogimise vorm -->
	
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="email" name="email_input" placeholder="Kasutajatunnus ehk e-post" value="<?php echo $email; ?>">
        <input type="password" name="password_input" placeholder="salasõna">
        <input type="submit" name="login_submit" value="Logi sisse"><?php echo $notice; ?>
    </form>
    <p>Loo omale <a href="fun_add_user.php">kasutajakonto</a></p>
    <hr>
	
	<!-- hitwebcounter Code START -->
<a href="https://www.hitwebcounter.com" target="_blank">
<img src="https://hitwebcounter.com/counter/counter.php?page=7862612&style=0009&nbdigits=5&type=page&initCount=0" title="Free Counter" Alt="web counter"   border="0" /></a>                                    
	<p><b>See on minu veebileht.</b></p>
	<img src="haikyuu.jpg" alt="Haikyuu poster" width="500"></img>
	<img src="monster.gif" alt="Monsteri logo gif"></img>
<p>Minu top 10 Monsteri maitset: <br>
	1. Monster Mule <br> 2. Pacific punch <br> 3. Ultra fiesta mango <br> 4. Ultra violet <br> 5. Monster Ripper <br> 6. Monarch <br> 7. Ultra black</p>
	<?php echo $photo_html; ?>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
</body>
</html>
