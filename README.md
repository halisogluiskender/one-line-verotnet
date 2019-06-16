# One Line Verotnet
Verot.net Classını tek satırda kullanılması için oluşturulan fonksiyon.
# Verotnet Fonksiyonu
```php
<?php
//  Tek satır tek verotnet uygulaması.
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
			$image->file_new_name_body = $picsName;											// Resim Adı
			$image->Process($picsPath);														// 'upload' Dosya yüklenecek yer

			if ( !$image->processed ){
				$image->error;
			}
		
		} else{
			$image->error;
		}	
}
?>
```
# Html Form Yapısı
Form tanımı yapılırken  **enctype="multipart/form-data"**  şeklinde bir parametreyi yazmayı unutmuyoruz. Örnekteki gibi bir yapı kullanabilirsiniz.
```html
<form action="" method="post" enctype="multipart/form-data">
    Dosya seçin: <input type="file" name="image" /><hr />
    <input type="submit" name="submit" value="Yükle" />
</form>
```
# Verotet Fonksiyonunu kullanımı
```php
<?php
	include "function.php";
	
	if ( isset($_POST['submit']) ){

		verotnet($_FILES['image']/*file_name*/,'Pics_'/*pics_pre*/,'resim'/*pics_name*/,'upload'/*path*/,'image/*'/*type*/,''/*pics_h*/,''/*pics_w*/,''/*picsCuolity*/,true/*resize*/,true/*crop*/,''/*wtr_mrk*/,''/*wtr_pos*/);
	}

?>
```
# Kaynak
[Verotnet](https://www.verot.net)
