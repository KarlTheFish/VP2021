<?php
session_start();
require_once("fun_movie.php");
require_once("fnc_user.php");
if (isset($_SESSION["user_id"])){
    $author_name = $_SESSION["user_name"];
    
    color($_SESSION["user_id"]);
        $css_colors = "<style> \n";
        $css_colors .= "\t body { \n";
        $css_colors .= "\t \t background-color: " .$_SESSION["bg_color"] ."; \n";
        $css_colors .= "\t \t color: " .$_SESSION["text_color"] ."; \n";
        $css_colors .= "\t } \n </style> \n";
    }
else{
    $author_name = "Karli";
    
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
