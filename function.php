<?php
//  Tek satır  tek dosya yükleme verotnet uygulaması
function verotnet($filename, $NamePre, $picsName, $picsPath, $imgtype, $picsH = NULL, $picsW = NULL, $picsCuolity = NULL, $picsResize, $picsCrop, $imgWTRmrk = NULL, $imgWTRmrkPos = NULL)
{
	require 'class.upload.php';

	$files = array();
	foreach ($filename as $k => $l) {
		if (is_array($l)) {
			foreach ($l as $i => $v) {
				if (!array_key_exists($i, $files)) {
					$files[$i] = array();
				}
				$files[$i][$k] = $v;
			}
		} else {
			$files[0][$k] = $l;
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
