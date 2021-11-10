<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
require("fnc_header.php");
require_once("fun_movie.php");
require_once("Classes/Photoupload.class.php");

$photo_store_notice = null;
$file_name_prefix = "VP_";
$watermark_file = "pics/vp_logo.png";
$file_name = null;
$alt_text_input = null;
$privacy = 1;
$photo_file_size_limit = 1024 * 1024;
$image_width_limit = 600;
$image_height_limit = 400;


if(isset($_POST["photo_submit"])){
    $alt_text = $_POST["alt_input"];
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
    
	$photo_upload = new Photoupload($_FILES["photo"], $file_type);
	
		
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
	
	$photo_upload->photo_resize($image_width, $image_height, false, false);
	
	$photo_upload->save_photo($upload_photo_normal_dir . $file_name);
	
    $photo_upload->photo_resize($image_width, $image_height, false, true);
	
	$photo_upload->save_photo($upload_photo_thum_dir . $file_name);
	
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
<?php require("fnc_footer.php") ?>
</html>
