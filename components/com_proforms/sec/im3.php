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

	$alphanumeric = "0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
	$chars = explode(",",$alphanumeric);
	$captcha = "";
	for ($t=0;$t<6;$t++){
		$captcha .= $chars[rand(0,61)];
	}	
	$mainframe =& JFactory::getApplication();
	
	
	
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
	$mainframe->setUserState("m4j_captcha",$captcha);
	imagettftext($im, 22, 8, 25, 32, $letter_color, $secDir."im3.ttf", $captcha);
}else{
	$font = imageloadfont($secDir."bubblebath.gdf");
	$captcha = substr($captcha,0,5);
	$mainframe->setUserState("m4j_captcha",$captcha); 
	imagestring($im , $font , 0 , 0 , $captcha , $letter_color );
}

$letter = imagecreate(160,32);
if(function_exists("imageantialias")){
	imageantialias($letter,true);
}
imagecolorallocate ($letter, 255, 255, 255);
$black = imagecolorallocate($letter,0,0,0); 

	for($n=0;$n<32;$n++)
		{
		$add = sin(rad2deg($n/240))*4;
		imagecopyresized($letter,$im,$add,$n,0,$n,160,1,160,1);
		}

ImagePNG ($letter);
imagedestroy($letter);
imagedestroy($im);
exit();
?>

