<?php 
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

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

require_once(JPATH_ROOT . '/administrator/components/com_proforms/includes/evolution.php');
include_once (JPATH_ROOT.'/administrator/components/com_proforms/defines.proforms.php');
// get the file class
jimport('joomla.filesystem.file'); 
// get the folder class
jimport('joomla.filesystem.folder'); 
// get the path class
jimport('joomla.filesystem.path'); 	
	
function com_install(){	
	global $m4jConfig_lang;
	
	$newVersion = "1.2";
	$newBuild = 107;
	$backupCompat = 106;
	
	$build = null;
	$db = & JFactory::getDBO();
	$db->setQuery("SELECT `value` FROM `#__m4j_config` WHERE `key` = 'M4J_BUILD' LIMIT 1");
	$config = $db->loadObject();
	if($config) $build = (int) $config->value;
	
	
	if(! $build){
		
		$build = $newBuild;
		
		$db->setQuery("
			INSERT INTO `#__m4j_config` (`key`, `value`, `type`, `namespace`) VALUES
			('M4J_EMAIL_ROOT', 'you@yourdomain.com', 'string', 'main'),
			('M4J_MAIL_ISO', 'utf-8', 'string', 'main'),
			('M4J_FROM_NAME', 'Your From Name', 'string', 'main'),
			('M4J_FROM_EMAIL', 'from_mail@yourdomain.com', 'string', 'main'),
			('M4J_CAPTCHA', 'RECAPTCHA', 'string', 'main'),
			('M4J_RECAPTCHA', 'red', 'string', 'main'),
			('M4J_HELP_ICON', '3', 'int', 'main'),
			('M4J_MAX_OPTIONS', '19', 'int', 'main'),
			('M4J_CAPTCHA_DURATION', '5', 'int', 'main'),
			('M4J_HTML_MAIL', '1', 'int', 'main'),
			('M4J_SHOW_LEGEND', '1', 'int', 'main'),
			('M4J_SUBMISSION_TIME', '10000', 'int', 'main'),
			('M4J_FORM_TITLE', '1', 'int', 'main'),
			('M4J_SHOW_NO_CATEGORY', '1', 'int', 'main'),
			('M4J_FORCE_CALENDAR', '0', 'int', 'main'),
			('M4J_STORAGE_TD', '250', 'int', 'main'),
			('M4J_WORKAREA', '940', 'int', 'main'),
			('M4J_CLASS_HEADING', 'contentheading', 'string', 'css'),
			('M4J_CLASS_LIST_HEADING', 'm4j_list_heading', 'string', 'css'),
			('M4J_CLASS_LIST_INTRO', 'm4j_list_intro', 'string', 'css'),
			('M4J_CLASS_LIST_WRAP', 'm4j_list_wrap', 'string', 'css'),
			('M4J_CLASS_HEADER_TEXT', 'm4j_header_text', 'string', 'css'),
			('M4J_CLASS_FORM_WRAP', 'm4j_form_wrap', 'string', 'css'),
			('M4J_CLASS_FORM_TABLE', 'm4j_form_table', 'string', 'css'),
			('M4J_CLASS_ERROR', 'm4j_error', 'string', 'css'),
			('M4J_CLASS_SUBMIT_WRAP', 'm4j_submit_wrap', 'string', 'css'),
			('M4J_CLASS_SUBMIT', 'm4j_submit', 'string', 'css'),
			('M4J_CLASS_RESET', 'm4j_reset', 'string', 'css'),
			('M4J_CLASS_REQUIRED', 'm4j_required', 'string', 'css'),
			('M4J_SHOW_USER_INFO', '1', 'int', 'main'),
			('M4J_FORCE_ADMIN_LANG', '', 'string', 'main'),
			('M4J_USE_JS_VALIDATION', '1', 'int', 'main'),
			('M4J_VERSION_NO', '$newVersion', 'string', 'main'),
			('M4J_ERROR_COLOR', 'ff0000', 'string', 'main'),
			('M4J_BUILD', '$newBuild', 'int', 'update'),
			('M4J_SERVICE_KEY', 'Please enter your service key here', 'string', 'update'),
			('M4J_UNIQUE_ID', NULL , 'string', 'update'),
			('M4J_IS_BASIC', '1' , 'string', 'update'),
			('M4J_BACKUP_COMPAT', '$backupCompat', 'int', 'update');			
		");
		$db->query();
	}
	
	if($build < $newBuild){
		
		$sql107 = array(
			"UPDATE `#__m4j_config` SET `value` = '$newVersion' WHERE `key` = 'M4J_VERSION_NO' LIMIT 1 ;",
			
			"UPDATE `#__m4j_config` SET `value` = '$newBuild' WHERE `key` = 'M4J_BUILD' LIMIT 1 ;",
		
			"UPDATE `#__m4j_config` SET `value` = '$backupCompat' WHERE `key` = 'M4J_BACKUP_COMPAT' LIMIT 1 ;"
		);
		
		foreach($sql107 as $query){
			$db->setQuery($query);
			$db->query();
		}
	}//EOF BULD < new build
	
	
	
			
	$jVersion = new JVersion;
	$j = $jVersion->getShortVersion();
	
	if(substr($j,0,3) != '1.5'){
		// Correcting Joomla's admin menu bug
		$db->setQuery("SELECT * FROM `#__extensions`  WHERE `element` = 'com_proforms' AND `type` = 'component' LIMIT 1;");
		$extensions = $db->loadObject();
		if($extensions){
			$extension_id = (int) $extensions->extension_id;
			$db->setQuery("UPDATE `#__menu` SET `component_id` = '$extension_id' WHERE `client_id` = '1' AND `title` = 'COM_PROFORMS' ;");
			$db->query();
		}
	}else{
		// Correcting J1.5 entry
		$db->setQuery("UPDATE `#__components` SET `name` = 'Proforms Basic', `admin_menu_alt` = 'Proforms Basic' WHERE `link` = 'option=com_proforms';");
		$db->query();
	}
	
	//Check workarea bug
	$db->setQuery("SELECT `value` FROM `#__m4j_config` WHERE `key` = 'M4J_WORKAREA' LIMIT 1");
	$cfg = $db->loadObject();
	if($cfg) {
		$wa = (int) $cfg->value;
		if($wa < 640){
			$db->setQuery("UPDATE `#__m4j_config` SET `value` = '940' WHERE `key` = 'M4J_WORKAREA' LIMIT 1 ;");
			$db->query();
		}
	}	
	
	
	define('M4J_VERSION_NO',$newVersion);
	define('M4J_BUILD',$newBuild);
	
	if(file_exists(JPATH_ROOT.'/administrator/components/com_proforms/language/'.$m4jConfig_lang.'/info.php')){
		include_once(JPATH_ROOT.'/administrator/components/com_proforms/language/'.$m4jConfig_lang.'/info.php');
	}else {
		include_once(JPATH_ROOT.'/administrator/components/com_proforms/language/en/info.php');
	}
	
}

?>
