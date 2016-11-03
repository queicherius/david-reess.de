<?php

/*
 * @TODO bei gif transparenz
 */

if ($_GET['type'] != 'jpg'
and $_GET['type'] != 'jpeg'
and $_GET['type'] != 'png'
and $_GET['type'] != 'gif'
and $_GET['type'] != 'wbmp')
{
	die('Dieses bild kann leider nicht erzeugt werden.');
}

if (preg_match('#\.\.#', $_GET['path']) or
    preg_match('#\.\.#', $_GET['resize']) or
    preg_match('#\.\.#', $_GET['type']))
{
	die('Man kann in den Ordnern nicht zurückspringen, da das ein zu großes Sicherheitsrisiko wäre.');
}

$image_path = '../'.$_GET['path'].'.'.$_GET['type'];
$new_image_path = '../'.$_GET['path'].'.'.$_GET['resize'].'.'.$_GET['type'];

function resizeImage($image_resource)
{
	global $image_path;
	$imagesize = getimagesize($image_path);
	$image_width = $imagesize[0];
	$image_height = $imagesize[1];
	$resize_array = explode('x', $_GET['resize']);

  if(!is_numeric($resize_array[1])){
      $crop = true;
      $resize_array[1] = str_replace("c", "", $resize_array[1]);
  }

	$new_image_width = (int) $resize_array[0];
	$new_image_height = (int) $resize_array[1];

	if ($new_image_height == '')
	{
		$new_image_height = intval($image_height*$new_image_width/$image_width);
	}


	if ($new_image_width == '')
	{
		$new_image_width = intval($image_width*$new_image_height/$image_height);
	}

	$new_image = imagecreate($new_image_width, $new_image_height);
	imagecopyresized($new_image, $image_resource, 0, 0, 0, 0, $new_image_width, $new_image_height, $image_width, $image_height);
	imagedestroy($image_resource);
	return $new_image;
}

switch ($_GET['type'])
{
	default: die('error');
	break;
case 'gif':
	Header('Content-type: image/gif');
	$image = imagecreatefromgif($image_path);
  $image = resizeImage($image);
  imagegif($image, $new_image_path);
  imagegif($image);
	break;
case 'jpeg':
case 'jpg';
  Header('Content-type: image/jpeg');
  $image = imagecreatefromjpeg($image_path);
  $image = resizeImage($image);
  imagejpeg($image, $new_image_path );
  imagejpeg($image);
break;
case 'png':
	Header('Content-type: image/png');
	$image = imagecreatefrompng($image_path);
	$image = resizeImage($image);
	imagepng($image, $new_image_path );
	imagepng($image);
	break;
case 'wbmp':
	Header('Content-type: image/wbmp');
	$image = imagecreatefromwbmp($image_path);
	$image = resizeImage($image);
	imagewbmp($image, $new_image_path );
	imagewbmp($image);
	break;
}
?>