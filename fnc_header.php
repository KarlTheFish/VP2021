<?php
require_once("fun_movie.php");
require_once("fnc_user.php");
color($_SESSION["user_id"]);
$css_colors = "<style> \n";
    $css_colors .= "\t body { \n";
    $css_colors .= "\t \t background-color: " .$_SESSION["bg_color"] ."; \n";
    $css_colors .= "\t \t color: " .$_SESSION["text_color"] ."; \n";
    $css_colors .= "\t } \n </style> \n";
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $_SESSION["user_name"]; ?>, veebiprogrammeerimine</title>
    <?php echo $css_colors; ?>
</head>
<body>
