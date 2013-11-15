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

//* Apps Folders	
	define("M4J_APPS_BASE", JPATH_ROOT . '/components/com_proforms/apps/');
	define("M4J_HTTP_APPS", $m4jConfig_live_site . '/components/com_proforms/apps/');
	
//* Folders
	define("M4J_LANG", JPATH_ROOT . '/components/com_proforms/language/');
	define("M4J_JS_CALNEDAR", JPATH_ROOT . '/components/com_proforms/js/calendar/');
	define("M4J_TMP", JPATH_ROOT . '/components/com_proforms/tmp/');
	define("M4J_LAYOUT", JPATH_ROOT . '/administrator/components/com_proforms/layout/');
	
//* Include Constants
	define("M4J_INCLUDE_CALENDAR", JPATH_ROOT . '/components/com_proforms/includes/calendar.php');
	define("M4J_INCLUDE_VALIDATE", JPATH_ROOT . '/components/com_proforms/includes/validate.php');
	define("M4J_INCLUDE_STORAGE", JPATH_ROOT . '/components/com_proforms/includes/storage.php');
	define("M4J_INCLUDE_JSONTEXT", JPATH_ROOT . '/components/com_proforms/includes/jsontext.php');
	define("M4J_INCLUDE_ROOT", JPATH_ROOT . '/components/com_proforms/includes/root.php');
	define("M4J_INCLUDE_CATEGORY", JPATH_ROOT . '/components/com_proforms/includes/category.php');
	define("M4J_INCLUDE_FORM", JPATH_ROOT . '/components/com_proforms/includes/form.php');
	define("M4J_INCLUDE_SEND", JPATH_ROOT . '/components/com_proforms/includes/send.php');
	define("M4J_INCLUDE_EXTRAFUNCTIONS", JPATH_ROOT . '/components/com_proforms/includes/extrafunctions.php');
	define("M4J_INCLUDE_PLUGINMANAGERDUMMY", JPATH_ROOT . '/components/com_proforms/includes/pluginmanagerdummy.php');
	define("M4J_INCLUDE_PLUGINMANAGER", JPATH_ROOT . '/components/com_proforms/includes/pluginmanager.php');
	define("M4J_INCLUDE_PLUGIN", JPATH_ROOT . '/components/com_proforms/includes/plugin.php');
	define("M4J_INCLUDE_APPS", JPATH_ROOT . '/components/com_proforms/includes/apps.php');
	define("M4J_INCLUDE_CONTROLLER", JPATH_ROOT . '/components/com_proforms/includes/mcontroller.php');
	define("M4J_INCLUDE_VIEW", JPATH_ROOT . '/components/com_proforms/includes/mview.php');
	define("M4J_INCLUDE_MODEL", JPATH_ROOT . '/components/com_proforms/includes/mmodel.php');
	
//* Include Constants Backend	
	define("M4J_INCLUDE_CONFIGURATION", JPATH_ROOT . '/administrator/components/com_proforms/config.proforms.php');
	define("M4J_INCLUDE_RESET_CONFIGURATION", JPATH_ROOT . '/administrator/components/com_proforms/includes/reset_config.php');
	define("M4J_INCLUDE_FUNCTIONS", JPATH_ROOT . '/administrator/components/com_proforms/includes/functions.php');
	define("M4J_INCLUDE_LIBCURL", JPATH_ROOT . '/administrator/components/com_proforms/libcurl/libcurlemu.inc.php');
	define("M4J_INCLUDE_TEMPLATER", JPATH_ROOT . '/administrator/components/com_proforms/includes/templater.php');
	define("M4J_INCLUDE_LAYOUT", JPATH_ROOT . '/administrator/components/com_proforms/includes/layout.php');
	define("M4J_INCLUDE_MDB", JPATH_ROOT . '/administrator/components/com_proforms/includes/mdb.php');		
	define("M4J_INCLUDE_APPTEXT", JPATH_ROOT . '/administrator/components/com_proforms/includes/apptext.php');	
	define("M4J_INCLUDE_APPDB", JPATH_ROOT . '/administrator/components/com_proforms/includes/appdb.php');	
	
//* HTTP Contstants
	define("M4J_HOME", 'index.php?option=com_proforms');
	define("M4J_FRONTEND", $m4jConfig_live_site . '/components/com_proforms/');
	define("M4J_FRONTEND_CALENDAR", M4J_FRONTEND . 'js/calendar/');
	define("M4J_FRONTEND_BALOONTIP", M4J_FRONTEND . 'js/balloontip/bubble-tooltip.js?basic=1');
	define("M4J_FRONTEND_BALOONTIP_CSS", M4J_FRONTEND . 'js/balloontip/bubble-tooltip.css?basic=1');
	define("M4J_FRONTEND_CAPTCHA_CSS",M4J_FRONTEND.'sec/css.php?m4j_c=');
	define("M4J_CSS", M4J_FRONTEND . 'css/stylesheet.css');	
	define("M4J_CSS_SYSTEM", M4J_FRONTEND . 'css/system.css');	
	define("M4J_FRONTEND_DOJO", M4J_FRONTEND . 'js/dojo.js?basic=1');
	define("M4J_FRONTEND_EVALUATION", M4J_FRONTEND . 'js/evaluation.js?basic=1');
	define("M4J_FRONTEND_UNDERLINE", M4J_FRONTEND . 'js/underline.js?basic=1');
	define("M4J_FRONTEND_MOOJ", M4J_FRONTEND . 'js/mooj.js?basic=1');
	define("M4J_HTTP_LAYOUT", $m4jConfig_live_site . '/administrator/components/com_proforms/layout/');
	define("M4J_FRONTEND_JS", M4J_FRONTEND . 'js/');
	
//* ACTIONS	
	define("M4J_CID", M4J_HOME.'&cid=');
	define("M4J_JID", M4J_HOME.'&jid=');
	define("M4J_SEND", M4J_HOME.'&send=');
	define("M4J_OPTIN", M4J_HOME.'&opt=in&ident=');
	define("M4J_OPTOUT", M4J_HOME.'&opt=out&ident=');
	
?>