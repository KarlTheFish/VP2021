<?php
	//require_once("fnc_session.php");
	require_once("fun_movie.php");
	require_once("fnc_user.php");
	if (isset($_SESSION["user_id"])){
		$author_name = $_SESSION["user_name"];

		color($_SESSION["user_id"]);
		$css_colors = "<style> \n";
		$css_colors .= "\t body { \n";
		$css_colors .= "\t \t background-color: " .$_SESSION["bg_color"] ."; \n";
		$css_colors .= "\t \t color: " .$_SESSION["text_color"] ."; \n";
		$css_colors .= "\t }\n";
		$css_colors .= "\t a:link { \n";
		$css_colors .= "\t \t color: " .$_SESSION["text_color"] ."; \n } \n";
		$css_colors .= "\t a:visited { \n";
		$css_colors .= "\t \t color: " .$_SESSION["text_color"] ."; \n } \n";
		$css_colors .= "\t a:hover { \n";
		$css_colors .= "\t \t color: #FFFFFF; \n }</style> \n";
	}
	else{
		$author_name = "Karl";

		$css_colors = "<style> \n";
		$css_colors .= "\t body { \n";
		$css_colors .= "\t background-color: #000000; \n";
		$css_colors .= "\t color: #00FF1F; \n";
		$css_colors .= "\t } \n </style> \n";
	}
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
    <?php echo $css_colors; ?>
</head>
<body>
	<h1><center><img src="banana.gif" alt="tantsiv banaan" width=100></img> <?php echo $author_name;?>i veebileht <img src="banana.gif" alt="tantsiv banaan" width=100></img></center></h1>
