<?php
	class Photoupload{
		private $photo_to_upload;
		private $file_type;
		private $temp_image;
		private $new_temp_image;
		
		function __construct($photo, $file_type){
			$this->photo_to_upload = $photo;
			$this->file_type = $file_type;
			$this->new_temp_image = $this->create_image_from_file($this->photo_to_upload["tmp_name"], $this->file_type);
		}
		
		private function create_image_from_file($photo, $file_type){
			if($file_type == "jpg"){
				$this->temp_image = imagecreatefromjpeg($photo);
			}
			if($file_type == "png"){
				$this->temp_image = imagecreatefrompng($photo);
			}
			if($file_type == "gif"){
				$this->temp_image = imagecreatefromgif($photo);
			}
		}
		
		public function photo_resize($image_width, $image_height, $isMax, $isThumbnail){
			global $image_width_limit;
			global $image_height_limit;
			global $watermark_file;
			if($isThumbnail == false){
				if(($image_width / $image_width_limit) > ($image_height / $image_height_limit)){
					$image_size_ratio = $image_width / $image_width_limit;
				}
				else {
					$image_size_ratio = $image_height / $image_height_limit;
				}
				$image_new_width = round($image_width / $image_size_ratio);
				$image_new_height = round($image_height / $image_size_ratio);
			}
			elseif($isThumbnail == true){
				$image_new_width = 100;
				$image_new_height = 100;
			}

			//uue väiksema pildiobjekti loomine

			$this->new_temp_image = imagecreatetruecolor($image_new_width, $image_new_height);

			//säilitame vajadusel läbipaistvuse

			imagesavealpha($this->new_temp_image, true); 
			$trans_color = imagecolorallocatealpha($this->new_temp_image, 0, 0, 0, 127);
			imagefill($this->new_temp_image, 0, 0, $trans_color);

			imagecopyresampled($this->new_temp_image, $this->temp_image, 0, 0, 0, 0, $image_new_width, $image_new_height, $image_width, $image_height);
			

			//vesimärgi lisamine
			if($isThumbnail == false){
				$watermark = imagecreatefrompng($watermark_file);
				$watermark_width = imagesx($watermark);
				$watermark_height = imagesy($watermark);
				$watermarkX = $image_new_width - $watermark_width - 10;
				$watermarkY = $image_new_height - $watermark_height - 10;

			imagecopy($this->new_temp_image, $watermark, $watermarkX, $watermarkY, 0, 0, $watermark_width, $watermark_height);
			}
		}
		
		public function save_photo($target) {
			$notice = null;
			global $file_name;
			global $alt_text;
			global $privacy;
			if($this->file_type == "jpg"){
				if(imagejpeg($this->new_temp_image, $target,90)){
					$notice = "Foto salvestamine õnnestus";
				}
				else{
					$notice = "Foto salvestamisel tekkis viga";
				}
			}
			if($this->file_type == "png"){
				if(imagepng($this->new_temp_image, $target,6)){
					$notice = "Foto salvestamine õnnestus";
				}
				else{
					$notice = "Foto salvestamisel tekkis viga";
				}
			}
			if($this->file_type == "gif"){
				if(imagegif($this->new_temp_image, $target)){
					$notice = "Foto salvestamine õnnestus";
				}
				else{
					$notice = "Foto salvestamisel tekkis viga";
				}
			}
			$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
			echo $connection->error;

			$connection->set_charset("utf8");

			$state = $connection->prepare("SELECT id FROM vprg_photos WHERE filename = ?");

			$state->bind_param("s", $file_name);
			$state->bind_result($photo_id);
			$state->execute();
			if(!($state->fetch())){
				$state->close();
				$state = $connection->prepare("INSERT INTO vprg_photos (userid, filename, alttext, privacy) VALUES (?, ?, ?, ?)");
				$state->bind_param("issi", $_SESSION["user_id"], $file_name, $alt_text, $privacy);
				if(!($state->execute())){
					echo "Pildi salvestamisel tekkis viga!";
					echo $connection->error;
				}
			}

			$state->close();
			$connection->close();
			

			return $notice;
		}
	}
?>