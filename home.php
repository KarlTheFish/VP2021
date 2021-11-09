<?php
require("fnc_header.php");

    if(!isset($_SESSION["user_id"])){
	header("Location: page.php");
    }
    
    if(isset($_GET["logout"])){
	session_destroy();
	header("Location: page.php");
}

?>
	<h1><?php echo $author_name; ?>i leht</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
    <p>Olemegi sisse loginud!</p>
    <p><a href="?logout=1">Logi välja</a></p>
	<hr>
	<li><a href="page.php">Avalehele</a>
	<li><a href="page3.php">Filmide list</a>
	<li><a href="fun_add_films.php">Filmide lisamine</a>
	<li><a href="photo_upload_gallery.php">Piltide galerii ja üleslaadimine</a>
	<li><a href="fun_user_profile.php">Kasutajaprofiil</a></li>
</body>

<?php require("fnc_footer.php"); ?>
</html>
