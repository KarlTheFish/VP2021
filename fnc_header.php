<?php

 $css_colors = "<style> \n";
    $css_colors .= "\t body { \n";
    $css_colors .= "\t \t background-color: " .$_SESSION["bg_color"] ."; \n";
    $css_colors .= "\t \t color: " .$_SESSION["text_color"] ."; \n";
    $css_colors .= "\t } \n </style> \n";
?>
<!DOCTYPE html> <!-- Vajalik HTML osa alguses -->
<html lang="et">
<head> <!-- Veebilehe kohta käiv info, mida näha ei ole -->
	<meta charset="utf-8"> <!-- meta kirjeldab andmeid; charset näitab, mis sümbolitabelit kasutatakse -->
	<title><?php echo $author_name;?>i leht kell <?php echo $time_hours. ":". $time_minutes; ?></title>
</head>
<body><!-- Veebilehe nähtav sisu -->
