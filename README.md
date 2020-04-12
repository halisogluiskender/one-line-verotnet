# One Line Verotnet
Verot.net Classını tek satırda kullanılması için oluşturulan fonksiyon.
# Verotnet Fonksiyonu
```php
//  Tek satırda dosya yükleme verotnet uygulaması
function verotnet($filename = array(), $NamePre, $picsName, $picsPath, $imgtype, $picsH = NULL, $picsW = NULL, $picsCuolity = NULL, $picsResize, $picsCrop, $imgWTRmrk = NULL, $imgWTRmrkPos = NULL)
{
	require 'class.upload.php';

	$files = array();
	foreach ($filename as $k => $l) {
		foreach ($l as $i => $v) {
			if (!array_key_exists($i, $files)) {
				$files[$i] = array();
			}
			$files[$i][$k] = $v;
		}
	}
	foreach ($files as $file) {
		$image = new Upload($file);

		if ($image->uploaded) {

			// Yüklenen dosya türü ÖR: 'image/*'
			$image->allowed = array($imgtype);
			// 100 Resim kalitesi
			$picsCuolity != NULL ? $image->jpeg_quality = $picsCuolity : NULL;
			// Resim ise genişlil değeri
			$picsW != NULL ? $image->image_x = $picsW : NULL;
			// Resim ise yükseklik değeri
			$picsH != NULL ? $image->image_y = $picsH : NULL;
			// Resim yeniden boyutlandırma  true yada false değeri alır
			$image->image_resize = $picsResize;
			// Resim kırpma true yada false değeri alır
			$image->image_ratio_crop = $picsCrop;
			// Resim watermakr (fligran) oluşturmak için sabit adres yolu yazılır
			$imgWTRmrk != NULL ? $image->image_watermark = $imgWTRmrk : NULL;
			// Watermark resim üzerinde posizyonlama ÖR: BR (bottom right)
			$imgWTRmrkPos != NULL ? $image->image_watermark_position = $imgWTRmrkPos : NULL;
			// Resim ön eki ÖR: 'thumb_'
			$image->file_name_body_pre = $NamePre;
			// Resim yeni adı
			$image->file_new_name_body = $picsName;
			// Resim yüklenecek yer
			$image->Process($picsPath);

			if (!$image->processed) {
				$image->error;
			}
		} else {
			$image->error;
		}
	}
}

```
# Html Form Yapısı
Form tanımı yapılırken  **enctype="multipart/form-data"**  şeklinde bir parametreyi yazmayı unutmuyoruz. Örnekteki gibi bir yapı kullanabilirsiniz.
```html
<form action="" method="post" enctype="multipart/form-data">
    Dosya seçin: <input type="file" name="image" /><hr />
    <input type="submit" name="submit" value="Yükle" />
</form>
```
Çoklu dosya yükleme örneği. Dikkat edilmesi gereken **name="image[]"** name özelliği array olmalı ve  inputa **multiple="multiple"** özelliği eklenmeli.
```html
<form action="" method="post" enctype="multipart/form-data">
    Dosya seçin: <input type="file" name="image[]" multiple="multiple" /><hr />
    <input type="submit" name="submit" value="Yükle" />
</form>
```
# Verotet Fonksiyonunu kullanımı
```php
include "function.php";

    if ( isset($_POST['submit']) ){

        verotnet($_FILES['image']/*file_name*/,'Pics_'/*pics_pre*/,'resim'/*pics_name*/,'upload'/*path*/,'image/*'/*type*/,''/*pics_h*/,''/*pics_w*/,''/*picsCuolity*/,true/*resize*/,true/*crop*/,''/*wtr_mrk*/,''/*wtr_pos*/);
    }

```
# Kaynak
[Verotnet](https://www.verot.net)
