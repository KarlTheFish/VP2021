<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga

$logon_email = null;
$logon_password = null;
$logon_error = null;

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
<body>
<form method="POST" action="">
    <label for="logon_email">Email</label>
    <input name="logon_email" id="logon_email" type="text" placeholder="email"> <br>
    <label for="logon_password">Parool</label>
    <input name="logon_password" id="logon_password" type="password"> <br>
    <input name="login_submit" id="login_submit" type="submit" value="Logi sisse">
</form>

</body>
</html>
