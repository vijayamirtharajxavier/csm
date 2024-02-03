<?php
	session_start(); 

	// Generate a random number 
	// from 10000-99999 
	$captcha = rand(10000,99999); 

	// The capcha will be stored 
	// for the session 
	$_SESSION["captcha"] = $captcha;  
    $capsess = $_SESSION["captcha"];
	// Generate a 350x36 standard captcha image
	$height = 50; 
	$width = 90;   
	$image_p = imagecreate($width, $height); 

	// Black color 
	$black = imagecolorallocate($image_p, 0, 0, 0);

	// White color 
	$white = imagecolorallocate($image_p, 255, 255, 255);

	// Print the captcha text in the image 
	// with random position & size  
	$font_size = 156; 
	imagestring($image_p, $font_size, 20, 20, $captcha, $white); 

	imagejpeg($image_p, null, 10); 

	// VERY IMPORTANT: Prevent any Browser Cache!! 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 

	// The PHP-file will be rendered as image 
	header('Content-type: image/png'); 

?>
