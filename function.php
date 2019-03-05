<?php
//  Tek satýr  tek resim ekleme verotnet uygulamasý
function verotnet($filename,$NamePre,$picsName,$picsPath,$imgtype,$picsH=NULL,$picsW=NULL,$picsCuolity=NULL,$picsResize,$picsCrop,$imgWTRmrk=NULL,$imgWTRmrkPos=NULL){
		require 'class.upload.php';
		$image = new Upload($filename);
		
		if ( $image->uploaded ){

			$image->allowed = array($imgtype);  											// 'image/*'
			if($picsCuolity!=NULL){$image->jpeg_quality = $picsCuolity;}					// 50 Resim kalitesi
			if($picsW!=NULL){$image->image_x = $picsW;}										// 500px
			if($picsH!=NULL){$image->image_y = $picsH;}										// 600px
			$image->image_resize = $picsResize;												// true OR false
			$image->image_ratio_crop = $picsCrop;											// true OR false
			if($imgWTRmrk!=NULL){$image->image_watermark = $imgWTRmrk;} 					//'watermark.png'
			if($imgWTRmrkPos!=NULL){$image->image_watermark_position = $imgWTRmrkPos;}		//'BR' - Bottom Right
			$image->file_name_body_pre = $NamePre;											//'thumb_'
			$image->file_new_name_body = $picsName;											// Resim Adý
			$image->Process($picsPath);														// 'upload' Dosya yüklenecek yer

			if ( !$image->processed ){
				$image->error;
			}
		
		} else{
			$image->error;
		}	
}

?>