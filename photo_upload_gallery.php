<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga

require_once("fun_movie.php"); 

$photo_store_notice = null;
$upload_photo_orig_dir = "upload_photo_og/";
$upload_photo_normal_dir = "upload_photo_normal/";
$upload_photo_thum_dir = "upload_photo_thumb/";
$file_name_prefix = "VP_";
$watermark_file = "pics/vp_logo.png";
$file_name = null;
$alt_text_input = null;
$privacy = 1;
$photo_file_size_limit = 1024 * 1024;
$image_width_limit = 600;
$image_height_limit = 400;


if(isset($_POST["photo_submit"])){
	$image_check = getimagesize($_FILES["photo"]["tmp_name"]);
	 if($image_check !== false){
            if($image_check["mime"] == "image/jpeg"){
                $file_type = "jpg";
            }
            if($image_check["mime"] == "image/png"){
                $file_type = "png";
            }
            if($image_check["mime"] == "image/gif"){
                $file_type = "gif";
            }
		
	$time_stamp = microtime(1) * 10000;
	
	$file_name = $file_name_prefix."_".$time_stamp.".".$file_type;
	
	//pildi suuruse muutmine
	//image objekti ehk pikslikogumi loomine
	
	if($file_type == "jpg"){
		$temp_image = imagecreatefromjpeg($_FILES["photo"]["tmp_name"]);
	}
	if($file_type == "png"){
		$temp_image = imagecreatefrompng($_FILES["photo"]["tmp_name"]);
	}
	if($file_type == "gif"){
		$temp_image = imagecreatefromgif($_FILES["photo"]["tmp_name"]);
	}
	
	//pildi originaalmöödud
	
	$image_width = imagesx($temp_image);
	$image_height = imagesy($temp_image);
	
	if(($image_width / $image_width_limit) > ($image_height / $image_height_limit)){
		$image_size_ratio = $image_width / $image_width_limit;
	}
	else {
		$image_size_ratio = $image_height / $image_height_limit;
	}
	
	$image_new_width = round($image_width / $image_size_ratio);
	$image_new_height = round($image_height / $image_size_ratio);
	
	//uue väiksema pildiobjekti loomine
	
	$new_temp_image = imagecreatetruecolor($image_new_width, $image_new_height);
	imagecopyresampled($new_temp_image, $temp_image, 0, 0, 0, 0, $image_new_width, $image_new_height, $image_width, $image_height);
	
	//vesimärgi lisamine
	
	$watermark = imagecreatefrompng($watermark_file);
	$watermark_width = imagesx($watermark);
	$watermark_height = imagesy($watermark);
	$watermarkX = $image_new_width - $watermark_width - 10;
	$watermarkY = $image_new_height - $watermark_height - 10;
	
	imagecopy($new_temp_image, $watermark, $watermarkX, $watermarkY, 0, 0, $watermark_width, $watermark_height);
	
	//salvestamine
	
	$photo_store_notice = save_photo($new_temp_image, $file_type, $upload_photo_normal_dir . $file_name);
	
	//kõrvaldame mälu vabastamiseks pikslikogumi
	
	#imagedestroy($new_temp_image);
	#imagedestroy($temp_image);
	#imagedestroy($watermark);
	
	//pildi üleslaadimine
	
	move_uploaded_file($_FILES["photo"]["tmp_name"], $upload_photo_orig_dir.$file_name);
	}
	else {
		$photo_store_notice = "Valitud fail ei ole pilt!";
	}
}

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
<body><!-- Veebilehe nähtav sisu -->

	<h1><center><img src="banana.gif" alt="tantsiv banaan" width=100></img> <?php echo $author_name;?>i veebileht <img src="banana.gif" alt="tantsiv banaan" width=100></img></center></h1>
	<h2><center>Fotode üleslaadimine ja galerii</center></h2>

	<h3>Isiku foto lisamine</h3>
	<form method="POST" enctype="multipart/form-data">
		<label for="photo_select">Vali pilt:</label>
	   <input type="file" name="photo" id="photo">
	   <br>
	   <label for="alt_input">Alternatiivtekst</label>
		<input type="text" name="alt_input" id="alt_input" placeholder="Alternatiivtekst pimedatele" value="<?php echo $alt_text_input; ?>">
		<br>
		<input type="radio" name="privacy_input" id="privacy_input_1" value="1" <?php if($privacy==1){echo " checked";}?>>
		<label for="privacy_input1">Privaatne(Ainult sina näed pilti)</label>
		<br>
		<input type="radio" name="privacy_input" id="privacy_input_2" value="2" <?php if($privacy==2){echo " checked";}?>>
		<label for="privacy_input1">Pilt nähtav ainult sisseloginud kasutajatele</label>
		<br>
		<input type="radio" name="privacy_input" id="privacy_input_3" value="3" <?php if($privacy==3){echo " checked";}?>>
		<label for="privacy_input1">Avalik(Kõik näevad pilti)</label>
		<br>
		<input type="submit" name="photo_submit" id="photo_submit">
	</form>
	<br>
	<span><?php echo $photo_store_notice ?></span>
</body>
<footer>
	<hr>
	<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
	<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>
	<hr>
</footer>
</html>
