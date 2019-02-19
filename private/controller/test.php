<?php
function image_handler($source_image, $destination, $tn_w = 100, $tn_h = 100, $quality = 80,
					   $wmsource = false)
{
	// The getimagesize functions provides an "imagetype" string contstant, which can be passed to the image_type_to_mime_type function for the corresponding mime type
	$info    = getimagesize($source_image);
	$imgtype = image_type_to_mime_type($info[2]);
	// Then the mime type can be used to call the correct function to generate an image resource from the provided image
	switch ($imgtype) {
		case 'image/jpeg':
			$source = imagecreatefromjpeg($source_image);
			break;
		case 'image/gif':
			$source = imagecreatefromgif($source_image);
			break;
		case 'image/png':
			$source = imagecreatefrompng($source_image);
			break;
		default:
			die('Invalid image type.');
	}
	// Now, we can determine the dimensions of the provided image, and calculate the width/height ratio
	$src_w     = imagesx($source);
	$src_h     = imagesy($source);
	$src_ratio = $src_w / $src_h;
	// Now we can use the power of math to determine whether the image needs to be cropped to fit the new dimensions, and if so then whether it should be cropped vertically or horizontally. We're just going to crop from the center to keep this simple.
	if ($tn_w / $tn_h > $src_ratio) {
		$new_h = $tn_w / $src_ratio;
		$new_w = $tn_w;
	} else {
		$new_w = $tn_h * $src_ratio;
		$new_h = $tn_h;
	}
	$x_mid = $new_w / 2;
	$y_mid = $new_h / 2;
	// Now actually apply the crop and resize!
	$newpic = imagecreatetruecolor(round($new_w), round($new_h));
	imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
	$final = imagecreatetruecolor($tn_w, $tn_h);
	imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h,
					   $tn_w, $tn_h);
	// If a watermark source file is specified, get the information about the watermark as well. This is the same thing we did above for the source image.
//	if ($wmsource) {
//		$info    = getimagesize($wmsource);
//		$imgtype = image_type_to_mime_type($info[2]);
//		switch ($imgtype) {
//			case 'image/jpeg':
//				$watermark = imagecreatefromjpeg($wmsource);
//				break;
//			case 'image/gif':
//				$watermark = imagecreatefromgif($wmsource);
//				break;
//			case 'image/png':
//				$watermark = imagecreatefrompng($wmsource);
//				break;
//			default:
//				die('Invalid watermark type.');
//		}
//		// Determine the size of the watermark, because we're going to specify the placement from the top left corner of the watermark image, so the width and height of the watermark matter.
//		$wm_w = imagesx($watermark);
//		$wm_h = imagesy($watermark);
//		// Now, figure out the values to place the watermark in the bottom right hand corner. You could set one or both of the variables to "0" to watermark the opposite corners, or do your own math to put it somewhere else.
//		$wm_x = $tn_w - $wm_w;
//		$wm_y = $tn_h - $wm_h;
//		// Copy the watermark onto the original image
//		// The last 4 arguments just mean to copy the entire watermark
//		imagecopy($final, $watermark, $wm_x, $wm_y, 0, 0, $tn_w, $tn_h);
//	}
	// Ok, save the output as a jpeg, to the specified destination path at the desired quality.
	// You could use imagepng or imagegif here if you wanted to output those file types instead.
	if (Imagejpeg($final, $destination, $quality)) {
		return true;
	}
	// If something went wrong
	return false;
}

?>
	<!-- Add a little image upload form -->
	<form method="post" enctype="multipart/form-data">
		Source Image: <input type="file" name="uploaded_image"/>
		<input type="submit" value="Handle This Image"/>
	</form>
<?php
//Process the form submission
if ($_FILES) {
	//get the uploaded image
	$source_image = $_FILES['uploaded_image']['tmp_name'];
	//specify the output path in your file system and the image size/quality
	$destination = '/path/to/the/final/image/filename.jpg';
	$tn_w        = 400;
	$tn_h        = 400;
	$quality     = 100;
	//path to an optional watermark
	$wmsource = '/path/to/your/watermark/image.png';
	// Try to process the image and echo a small message whether or not it worked. If the image is saved somewhere public, you could add an <img src> tag to display the image here, too!
	$success = image_handler($source_image, $destination, $tn_w, $tn_h, $quality, $wmsource);
	if ($success) {
		echo "Your image was saved successfully!";
	} else {
		echo "Your image was not saved.";
	}
}
?>