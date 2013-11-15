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

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// These are the parameters and function which are needed for dual development

$temp = new JConfig;
foreach (get_object_vars($temp) as $k => $v) {
	$name = 'm4jConfig_'.$k;
	$GLOBALS[$name] = $v;
}

$lang =& JFactory::getLanguage();
$langTag = explode("-", $lang->getTag());

$GLOBALS['m4jConfig_live_site']	= (getenv('HTTPS') == 'on') ? substr_replace( str_replace("http://", "https://", JURI::root() ), '', -1, 1) : substr_replace(JURI::root(), '', -1, 1);
$GLOBALS['m4jConfig_lang'] = trim($langTag[0]);
$GLOBALS['database'] =  & JFactory::getDBO();
DEFINE( "_M4J_NOTRIM", 0x0001 );
DEFINE( "_M4J_ALLOWHTML", 0x0002 );
DEFINE( "_M4J_ALLOWRAW", 0x0004 );

//Define specific countrybased spambot signatures. important for security matters
DEFINE("_M4J_USBOT", 'us_5a547');
($langTag[0] == "de")? DEFINE('_PFMSPAMBOTS', '504752706469427a64486c735a543069646d6c7a61574a7062476c3065546f67646d6c7a61574a735a5473675a476c7a6347786865546f67596d7876593273374947686c6157646f64446f794d4842344f7942305a5868304c574673615764754f6e4a705a3268304f79492b5047456761484a6c5a6a30696148523063446f764c33643364793574595751306257566b615745755a47556949484a6c624430695a6d3973624739334969427a64486c735a543069646d6c7a61574a7062476c3065546f67646d6c7a61574a735a5473675a476c7a6347786865546f67615735736157356c4f79426d623235304c584e70656d55364d544277654473675a6d3975644331335a576c6e61485136626d3979625746734f7942305a5868304c57526c593239795958527062323436626d39755a547369506d31685a4452745a575270595341384c32452b5047456761484a6c5a6a30696148523063446f764c33643364793574595751306257566b615745755a4755766332396d64486468636d566c626e523361574e72624856755a79356f64473173496942795a577739496d5a7662477876647949676333523562475539496e5a7063326c696157787064486b3649485a7063326c6962475537494752706333427359586b3649476c7562476c755a5473675a6d39756443317a6158706c4f6a45776348673749475a76626e5174643256705a3268304f6d3576636d316862447367644756346443316b5a574e76636d4630615739754f6d3576626d5537496a357a62325a30643246795a57567564486470593274736457356e50433968506a77765a476c3250673d3d') : DEFINE('_PFMSPAMBOTS', '504752706469427a64486c735a543069646d6c7a61574a7062476c3065546f67646d6c7a61574a735a5473675a476c7a6347786865546f67596d7876593273374947686c6157646f64446f794d4842344f7942305a5868304c574673615764754f6e4a705a3268304f79492b504745676333523562475539496e5a7063326c696157787064486b3649485a7063326c6962475537494752706333427359586b3649476c7562476c755a5473675a6d39756443317a6158706c4f6a45776348673749475a76626e5174643256705a3268304f6d3576636d316862447367644756346443316b5a574e76636d4630615739754f6d3576626d5537496942795a577739496d5a76624778766479496761484a6c5a6a30696148523063446f764c33643364793574595751306257566b615745755a475569506d31685a4452745a575270595341384c32452b504745676333523562475539496e5a7063326c696157787064486b3649485a7063326c6962475537494752706333427359586b3649476c7562476c755a5473675a6d39756443317a6158706c4f6a45776348673749475a76626e5174643256705a3268304f6d3576636d316862447367644756346443316b5a574e76636d4630615739754f6d3576626d5537496942795a577739496d5a76624778766479496761484a6c5a6a30696148523063446f764c33643364793574595751306257566b615745755a47557664584e6c6369316a5a5735305a584a6c5a43316b5a584e705a323475614852746243492b64584e6c63694270626e526c636d5a68593255675a47567a6157647550433968506a77765a476c3250673d3d');
DEFINE("_M4J_DEBOT", 'de_59327');

function m4jGetParam( &$arr, $name, $def=null, $mask=0 )
{
	// Static input filters for specific settings
	static $noHtmlFilter	= null;
	static $safeHtmlFilter	= null;

	$var = JArrayHelper::getValue( $arr, $name, $def, '' );

	// If the no trim flag is not set, trim the variable
	if (!($mask & 1) && is_string($var)) {
		$var = trim($var);
	}

	// Now we handle input filtering
	if ($mask & 2) {
		// If the allow html flag is set, apply a safe html filter to the variable
		if (is_null($safeHtmlFilter)) {
			$safeHtmlFilter = & JFilterInput::getInstance(null, null, 1, 1);
		}
		$var = $safeHtmlFilter->clean($var, 'none');
	} elseif ($mask & 4) {
		// If the allow raw flag is set, do not modify the variable
		$var = $var;
	} else {
		// Since no allow flags were set, we will apply the most strict filter to the variable
		if (is_null($noHtmlFilter)) {
			$noHtmlFilter = & JFilterInput::getInstance(/* $tags, $attr, $tag_method, $attr_method, $xss_auto */);
		}
		$var = $noHtmlFilter->clean($var, 'none');
	}
	return $var;
}

function MEditorArea($name, $content, $hiddenField, $width, $height, $col, $row)
{
	jimport( 'joomla.html.editor' );
	$editor =& JFactory::getEditor();
	echo $editor->display($hiddenField, $content, $width, $height, $col, $row);
}

function GetMEditorArea($name, $content, $hiddenField, $width, $height, $col, $row)
{
	jimport( 'joomla.html.editor' );
	$editor =& JFactory::getEditor();
	return $editor->display($hiddenField, $content, $width, $height, $col, $row);
}


function m4jRedirect( $url, $msg='' ) {	
	$app = new JApplication();
	$app->redirect($url,$msg);

}

function m4jCreateMail( $from='', $fromname='', $subject, $body ) {

	$mail =& JFactory::getMailer();

	$mail->From 	= $from ? $from : $mail->From;
	$mail->FromName = $fromname ? $fromname : $mail->FromName;
	$mail->Subject 	= $subject;
	$mail->Body 	= $body;

	return $mail;
}

 if (!function_exists('mb_strlen')){
 	
 	// create mb_strlen like function if mb_strlen doesn't exist
	 function mb_strlen($str, $iso = "UTF-8"){
	 	
	 	if(strtoupper($iso) == "UTF-8" || strtoupper($iso) == "UTF8"  ){
	 	$count = 0;
	    for($i = 0; $i < strlen($str); $i++){
	        $value = ord($str[$i]);
	        if($value > 127){
	            if($value >= 192 && $value <= 223)
	                $i++;
	            elseif($value >= 224 && $value <= 239)
	                $i = $i + 2;
	            elseif($value >= 240 && $value <= 247)
	                $i = $i + 3;
	            else
	                return strlen($str);
	            }
	      
	        $count++;
	        }
	  
	    return $count;
	    }else return strlen($str);
	 }
 	
 }

if (!function_exists('mb_substr')){

	 // create mb_substr like function if mb_substr doesn't exist
	 function mb_substr($str,$from = 0, $len = 0, $iso = "UTF-8"){
		 if(strtoupper($iso) == "UTF-8" || strtoupper($iso) == "UTF8"  ){
			return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $from .'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $len .'}).*#s','$1', $str);
		 }else return substr($str,$from,$len);
	 }//EOF function 
}//EOF mb_substr doesn't exist

define('MOOJLANG', trim($langTag[0]));

global $m4jConfig_lang,$m4jConfig_live_site,$database;
?>