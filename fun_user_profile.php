<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga
$notice = null;
?>
<head>
</head>
<body><!-- Veebilehe nähtav sisu -->

	<h1><center><img src="banana.gif" alt="tantsiv banaan" width=100></img> Kasutaja profiil <img src="banana.gif" alt="tantsiv banaan" width=100></img></center></h1>
	
	
   <form method="POST">
		<label for="description_input">Lühikirjeldus</label>
		<br>
		<textarea name="description_input" id="description_input" rows="10" cols="80" placeholder="Minu lühikirjeldus"></textarea>
		<br>
		<label for="bg_color_input"></label>
		<br>
		<input type="color" name="bg_color_input" id="bg_color_input">
		<br>
		<label for="text_color_input"></label>
		<br>
		<input type="color" name="text_color_input" id="text_color_input">
		<br>
        <input type="submit" name="profile_submit" value="Salvesta">
    </form>

</body>
<footer>
	<hr>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
	<hr>
</footer>
</html>
