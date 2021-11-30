<?php
	require_once("fnc_session.php");
	setcookie("vpvisitor", $_SESSION["user_name"], time() + (86400 * 8), "/~karvas/vp2021/Ryhm-3/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
	$last_visitor = null;
	if(isset($_SESSION["user_id"])){
		echo "Sessioon on";
	}
	else{
		echo "Sessiooni pole";
	}
    if(isset($_COOKIE["vpvisitor"]) and !empty($_COOKIE["vpvisitor"])){
        $last_visitor = $_COOKIE["vpvisitor"];
    }
	else{
		$last_visitor = "Küpsiseid ei ole";
	}
	require("fnc_header.php");
?>

	<h1><?php echo $author_name; ?>i leht</h1>
	
	<hr>
    <p>Olemegi sisse loginud!</p>
	<?php echo $last_visitor; ?>
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
