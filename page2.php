<!-- PHP failis vöib olla ka HTML, kuid failil endal peab alati olema .php laiend -->
<?php #andmeid hoitakse muutujates, aga ei pea ära määrama, mis tüüpi muutuja on. Muutuja nimi peab olema ingliskeelne, köikide muutujate nimed algavad $ märgiga, kasutatakse ainult väiketähti ja tühikute asemel on allkriips
$author_name = "Karl"; #PHP lause peab löppema semikooloniga
//juhusliku foto lisamine
$photo_dir = "pildid/";
$all_files = scandir($photo_dir); #failikataloogi skännimiseks scandir
$real_files = array_slice($all_files, 2);

//sõelume välja päris pildid
$photo_files = [];
	$allowed_photo_types = ["image/jpeg","image/png"];
	foreach($real_files as $file_name){
		$file_info = getimagesize($photo_dir .$file_name);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($photo_files, $file_name);
			} //if in_array
		} //if isset lõppeb
	} //foreach lõppes made by Rinde aitäh Rinde
	
require("fnc_header.php");

//suvalise foto valimine

$limit = count($photo_files);
$pic_nr = mt_rand(0, $limit - 1);
$ran_picture = $photo_files[$pic_nr];
$photo_html = '<img src="' .$photo_dir .$ran_picture . '" alt="Pilt" width="500">';

//fotode valiku nupu vajutamise kontroll

$user_photo_select = null;
if(isset($_POST["submit_picture"])){
	$user_photo_select = $_POST["photo_select"];
	$ran_picture = $photo_files[$user_photo_select];
	$pic_nr = $user_photo_select;
	$photo_html = '<img src="' .$photo_dir .$ran_picture . '" alt="Valitud pilt" width="500">';
}
//fotode valikumenüü
$photo_select_html = "\n".'<select name="photo_select">'."\n";
	for($i = 0; $i < $limit; $i++ ){
	if($i == $pic_nr){
		$photo_select_html .= '<option value="' .$i .'" selected>' .$photo_files[$i]. "</option> \n";
		}
    else{
    $photo_select_html .= '<option value="' .$i .'">' .$photo_files[$i]. "</option> \n";
    }
	}
	$photo_select_html .= "</select>";

//nimi fotode all

$photo_list_html = $ran_picture."<br>";

?>
<!DOCTYPE html> <!-- Vajalik HTML osa alguses -->
<html lang="et">

<?php
$todays_opinion_html = null;
$user_opinion = null;
$todays_opinion = null;
$todays_opinion_error = null;
if(isset($_POST["submit_opinion"]))
{ if(!empty($_POST["user_opinion"]))
	{
	$todays_opinion_html = "<p>Tänane päev on ".$_POST["user_opinion"].".</p>";
	$todays_opinion = $_POST["user_opinion"];
	}
	else
	{
	$todays_opinion_error = "<p>Sisestage arvamus enda päevast!</p>";
	}
}
?>
	<h2><center>Graphic design is my passion</center></h2>
	<form method="post">
	<?php echo $photo_html."<br>";
	echo $photo_list_html;
	echo $photo_select_html; ?>
	<input type="submit" name="submit_picture" value="Vali pilt">
	</form>
	<form method="post"> <!-- vormielement -->
		<hr>
		<input type="text" name="user_opinion" placeholder="Mida arvate tänasest päevast?" value="<?php echo $todays_opinion; ?>">
		<input type="submit" name="submit_opinion" value="Saada">
		<span><?php echo $todays_opinion_error; ?></span>
	</form>
	<?php echo $todays_opinion_html; ?>
</body>
<?php require("fnc_footer.php"); ?>
</html>
