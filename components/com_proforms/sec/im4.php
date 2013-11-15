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

	$alphanumeric = "0,1,2,3,4,5,6,7,8,9";
	$chars = explode(",",$alphanumeric);
	$captcha = "";
	
	for ($t=0;$t<6;$t++){
		$captcha .= $chars[rand(0,9)];
	}

	$mainframe =& JFactory::getApplication();	
	
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
	$mainframe->setUserState("m4j_captcha",$captcha);
	$font = JPATH_BASE.DS."components".DS."com_proforms".DS."sec".DS."im4.ttf";
	imagettftext($im, 22, -7, 25, 23, $letter_color, $font, $captcha);
}else{
	$font = imageloadfont($secDir."bubblebath.gdf");
	$captcha = substr($captcha,0,5);
	$mainframe->setUserState("m4j_captcha",$captcha); 
	imagestring($im , $font , 0 , 0 , $captcha , $letter_color );
}

ImagePNG ($im);
imagedestroy($im);
exit();


?>