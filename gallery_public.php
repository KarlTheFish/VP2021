<?php
require("fnc_header.php");
require_once("fun_movie.php");
	$css = '<link rel="stylesheet" type="text/css" href="style/gallery.css">';
	if(isset($css) and !empty($css)){
		echo $css;
	}
	
$page = 1;
$limit = 2;

?>
<body class="body">


<input id="rate1" name="rating">

<div>
	<p>
	<?php
	if($page > 1){
		echo '<span><a href="?page=' .($page - 1) .'">Eelmine leht</a></span> |' ."\n";
	} else {
		echo "<span>Eelmine leht</span> | \n";
	}
	if($page * $limit < 4){
		echo '<span><a href="?page=' .($page + 1) .'">Järgmine leht</a></span>' ."\n";
	} else {
		echo "<span>Järgmine leht</span> \n";
	}
	echo "</p>";
	 echo read_public_photo_thumbs(2); ?>
</div>
</body>
<?php require("fnc_footer.php"); ?>
