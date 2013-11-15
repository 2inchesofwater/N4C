<?PHP 
/**
* @name MOOJ Proforms 
* @version 1.0
* @package proforms
* @copyright Copyright (C) 2008-2010 Mad4Media. All rights reserved.
* @author Dipl. Inf.(FH) Fahrettin Kutyol
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Please note that some Javascript files are not under GNU/GPL License.
* These files are under the mad4media license
* They may edited and used infinitely but may not repuplished or redistributed.  
* For more information read the header notice of the js files.
**/

$first =rand(1,99);
$second=rand(1,10);	
$operator = (rand(0,100)<50)?"+":"-";
	
$result = ($operator=="+") ? ($first+$second) : ($first-$second);
$captcha = (string) $first.$operator.(string) $second;

$mainframe =& JFactory::getApplication();	
$mainframe->setUserState("m4j_captcha",$result);

$secDir = JPATH_BASE.DS."components".DS."com_proforms".DS."sec".DS; 	
	
header("Content-type: image/png");
if(! (extension_loaded('gd') && function_exists('gd_info')) ){
	echo file_get_contents($secDir."nogd.png");
	exit();
}

$im = imagecreate(160,32);

if(function_exists("imageantialias")){
	imageantialias($im,true);
}

imagecolorallocate ($im, 255, 255, 255);
$letter_color = imagecolorallocate($im,0,0,0); 

if(function_exists("imagettftext")){
	imagettftext($im, 22, -7, 25, 23, $letter_color, $secDir."im4.ttf", $captcha);
}else{
	$font = imageloadfont($secDir."font.gdf");
	imagestring($im , $font , 0 , 0 , $captcha , $letter_color );
}

ImagePNG ($im);
imagedestroy($im);
exit();
?>