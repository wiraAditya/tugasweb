<?php  
	function compress_image($source_url, $destination_url, $quality, $nama) {
    ini_set('memory_limit', '-1');
    
	include 'ImageResize.php';
	$info = getimagesize($source_url);
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source_url); 
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source_url); 
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source_url); 
        imagejpeg($image, $destination_url, $quality); 
	
	
	//use \Eventviva\ImageResize;
	//use \Eventviva\ImageResizeException;
	$imageR = new \Eventviva\ImageResize($destination_url);
	$imageR->save($destination_url);
	return $imageR; 
} 
?>