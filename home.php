<?php
	$author_name = "Karl";
	
	session_start();
    $_SESSION["user_id"] = $id_from_db;
    if(!isset($_SESSION["user_id"])){
	header("Location: page.php");
    }
    
//     if(isset($_GET["logout"])){
// 	session_destroy();
// 	header("Location: page.php");
// }

?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
    <p>Olemegi sisse loginud!</p>
    <p><a href="?logout=1">Logi välja</a></p>
	<hr>
	<li><a href="photo_upload_gallery.php">Piltide galerii ja üleslaadimine</a><li>
</body>
</html>
