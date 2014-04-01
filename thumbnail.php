<?php

/*
Created by : Mohammad Dayyan
Mds_soft@yahoo.com
1387/5/15
*/

function thumbnail_image($original_file_path, $new_width, $new_height, $save_path)
{
	$imgInfo = getimagesize($original_file_path);
	$imgExtension = "";

    switch ($imgInfo[2])
    {
	    case 1:
	    	$imgExtension = '.gif';
	   		break;

	    case 2:
	    	$imgExtension = '.jpg';
	    	break;

	    case 3:
	    	$imgExtension = '.png';
	    	break;
    }
	$imgName=rand(10000000,9999999999);
	
    $imgNameFull= "$save_path/$imgName".$imgExtension ;
  
    
    $imageName="$imgName".$imgExtension;

	// Get new dimensions
	list($width, $height) = getimagesize($original_file_path);

	// Resample
	$imageResample = imagecreatetruecolor($new_width, $new_height);

	if ( $imgExtension == ".jpg" )
	{
		$image = imagecreatefromjpeg($original_file_path);
	}
	else if ( $imgExtension == ".gif" )
	{
		$image = imagecreatefromgif($original_file_path);
	}
	else if ( $imgExtension == ".png" )
	{
		$image = imagecreatefrompng($original_file_path);
	}

	imagecopyresampled($imageResample, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	if ( $imgExtension == ".jpg" )
	{
		imagejpeg($imageResample, $imgNameFull);
	}
	else if ( $imgExtension == ".gif" )
	{
		imagegif($imageResample, $imgNameFull);
	}
	else if ( $imgExtension == ".png" )
	{
		imagepng($imageResample, $imgNameFull);
	}
	return $imageName;
	
}

?>