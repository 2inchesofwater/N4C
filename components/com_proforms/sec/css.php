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

header("Content-Type: text/css");

$captcha = null;
if (isset($HTTP_GET_VARS['m4j_c'])) $captcha = addslashes(strip_tags($HTTP_GET_VARS['m4j_c']));
$one = 'im.php?id='.$captcha;
$two = 'im2.php?cta='.$captcha;


?>

.m4j_one {
	background-image: url('<?PHP echo $one; ?>');
	background-repeat: no-repeat;
	background-position: 0px 0px;
	display: block;
	margin: 0px;
	padding: 0px;
	height: 16px;
	width: 160px;
	position: relative;
	top: 0px;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 0px;
	border-left-width: 0px;
}
.m4j_two {
	background-image: url('<?PHP echo $two; ?>');
	background-repeat: no-repeat;
	background-position: 0px 0px;
	display: block;
	margin: 0px;
	padding: 0px;
	height: 32px;
	width: 160px;
	vertical-align: top;
	
}

a.m4j_cover {
	background-image: url('hover.png');
	background-repeat: no-repeat;
	background-position: 0px 0px;
	display: block;
	margin: 0px;
	padding: 0px;
	height: 32px;
	width: 160px;
	top: -16px;
	position: relative;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 0px;
	border-left-width: 0px;
}
a.m4j_cover:hover  {
	background-position: 0px -32px;	
}