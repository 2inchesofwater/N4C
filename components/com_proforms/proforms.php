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

// Joomla 1.6 detection
$jVersion = new JVersion;
$j = $jVersion->getShortVersion();
$jsub = substr($j,0,3);
if($jsub == '1.5' ){
	define("_M4J_IS_J16" ,0);
}else{
	define("_M4J_IS_J16" ,1);
}
    
// remember human detection
$mf =& JFactory::getApplication();
$GLOBALS["proforms_is_human"] = $mf->getUserState( "proforms_is_human", 0 );

// Spamtrap has catched a bot
if(isset($_REQUEST['email']) && $_REQUEST['email'] != NULL) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit;
}

// Native captcha display
$cpta = JRequest::getInt("cpta", null);
if($cpta){
	if($cpta< 3 || $cpta>5) exit();
	if(file_exists(JPATH_BASE.DS."components".DS."com_proforms".DS."sec".DS."im".$cpta.".php")){
		include_once JPATH_BASE.DS."components".DS."com_proforms".DS."sec".DS."im".$cpta.".php" ;
	}else exit();
}

// Internal Debug
define("_MDEBUG",0);

// Firebug for IE
define("_IEFIREBUG",0);


// get the file class
jimport('joomla.filesystem.file'); 
// get the folder class
jimport('joomla.filesystem.folder'); 
// get the path class
jimport('joomla.filesystem.path'); 

// Action defines. Helps routing
define ('ACTION_ROOT',0);
define ('ACTION_CATEGORY',1);
define ('ACTION_FORM',2);
define ('ACTION_SEND',3);
	
// Legacy
define("M4J_ABS", JPATH_ROOT);
require_once(M4J_ABS . '/administrator/components/com_proforms/includes/evolution.php');
		
// Get defines	
require_once(M4J_ABS . '/components/com_proforms/frontend.defines.proforms.php');

// Get document
$document=& JFactory::getDocument();
// include the system CSS classes
$document->addStyleSheet(M4J_CSS_SYSTEM);

//Add dojo
//$document->addScript(M4J_FRONTEND_DOJO);

// Get the pseudo view (legacy of Joomla 1.0)
require_once(M4J_ABS . '/components/com_proforms/proforms.html.php');
//require_once(M4J_INCLUDE_LIBCURL);


// Get DB Helper
require_once(M4J_INCLUDE_MDB);

// Get the configuration defines from db
if(file_exists(M4J_INCLUDE_CONFIGURATION)) require_once(M4J_INCLUDE_CONFIGURATION);
else require_once(M4J_INCLUDE_RESET_CONFIGURATION);

// import reCaptcha Lib if reCaptcha is selected
if (M4J_CAPTCHA == "RECAPTCHA"){
	// Re Captcha
	require_once(M4J_ABS . '/components/com_proforms/includes/recaptchalib.php');
}

// Language file. If language file doesn't exist get the default (English) language file.
if(file_exists(M4J_LANG.'frontend.'.$m4jConfig_lang.'.php')) include_once(M4J_LANG.'frontend.'.$m4jConfig_lang.'.php');
else include_once(M4J_LANG.'frontend.en.php');

// bootstrap some classes and functions
require_once(M4J_INCLUDE_CALENDAR);
require_once(M4J_INCLUDE_FUNCTIONS);
require_once(M4J_INCLUDE_VALIDATE);
require_once(M4J_INCLUDE_STORAGE);
require_once(M4J_INCLUDE_EXTRAFUNCTIONS);

// a helper class for working with templates 
require_once(M4J_INCLUDE_TEMPLATER);
// get the layout and the layout list class
require_once(M4J_INCLUDE_LAYOUT);

// pseudo view object
$print = new HTML_mad4jobs();
$GLOBALS['print'] = $print;

// ** New to Proform's 1.1 App System ** 
// The very own text class for apps
require_once (M4J_INCLUDE_APPTEXT);
require_once(M4J_INCLUDE_APPDB);	


// check if we are processing an app view
$app = strtolower( JRequest::getString("app",null) );	

if($app){
	// App view processing
	// include App MVC
	require_once(M4J_INCLUDE_CONTROLLER);	
	require_once(M4J_INCLUDE_VIEW);	
	require_once(M4J_INCLUDE_MODEL);
	// App processing
	require_once(M4J_INCLUDE_APPS);
	$app = null;
}else{
	// Normal processing of forms and categories

	// init calendar script
	init_calendar();	
	$route = '';
	
	$cid = JRequest::getInt('cid',null);
	$jid = JRequest::getInt('jid',null);
	$send = m4jGetParam($_REQUEST, 'send');
	$submit = m4jGetParam($_REQUEST, 'submit');
	$itemID = JRequest::getInt('Itemid',null); 
	
	$GLOBALS['cid'] = $cid;
	$GLOBALS['jid'] = $jid;
	$GLOBALS['send'] = $send;
	$GLOBALS['submit'] = $submit;
	$GLOBALS['itemID'] = $itemID;

	$GLOBALS['isTooltip'] = 1;
	$GLOBALS['isRaw'] = 0;
	$GLOBALS['isRequiredAdvice'] = 1;
	$GLOBALS['isInFrame'] = 0;
	
	if($jid){
		// Prepare for displaying forms
		if($send){
			// Forms has been submitted and is ready to get processed
			$route = ACTION_SEND;	
		}else {
			// First call of form
			$route = ACTION_FORM;
		}			  
			  
	}elseif($cid) {
		// Routing to category
		$route = ACTION_CATEGORY;
	}
	
		
	
	define('_PROFORMS_VIEW', $route);

ob_start();	
	switch($route){
		
		case ACTION_ROOT:
			include_once M4J_INCLUDE_ROOT;
		break;
		
		case ACTION_CATEGORY:
			include_once M4J_INCLUDE_CATEGORY;
		break;
		
		case ACTION_FORM:
			include_once M4J_INCLUDE_FORM;
			$session =& JFactory::getSession();
			$session->clear("m4j_timestamp");
			$session->set("m4j_timestamp",uniqueTimeStamp());	
		break;	
		
		case ACTION_SEND:
			$session =& JFactory::getSession();
			$startTime= $session->get("m4j_timestamp");
			if(!$startTime) die();
			$elapsed = uniqueTimeStamp()-$startTime;
			if($elapsed < M4J_SUBMISSION_TIME)die();
			$session->clear("m4j_timestamp");
			$session->set("m4j_timestamp",uniqueTimeStamp());
			include_once M4J_INCLUDE_SEND;
		break;
	
	}//EOF switch
$print->render( ob_get_clean() );



}//EOF no app view
	
	if(_MDEBUG==1){
		MDebug::out();
	}

?>