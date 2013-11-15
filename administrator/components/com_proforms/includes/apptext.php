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

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

$GLOBALS["apptext"] = array();
$GLOBALS["currentApp"] = null;
class AText{
	
	function add($app = null, $filePostFix = null ){
		if(!$app) return;
		$filePostFix = $filePostFix ? ".".$filePostFix : "";		
		
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		
		$lang =& JFactory::getLanguage();
		$languageTag = $lang->getTag();
		
		$langPath = M4J_APPS_BASE.$app.DS."language".DS;
		$enPath = $langPath."en-GB".$filePostFix.".ini";
		$tagPath = $langPath.$languageTag.$filePostFix.".ini";
		
		$en = array(); $default = array();
		if(JFile::exists($enPath)){
			$en = parse_ini_file($enPath);
		}
		
		if(JFile::exists($tagPath)){
			$default = parse_ini_file($tagPath);
		}
		
		if(isset($GLOBALS["apptext"][$app]) ){
			$GLOBALS["apptext"][$app] = array_merge( $GLOBALS["apptext"][$app],  array_merge($en,$default) );
		}else{
			$GLOBALS["apptext"][$app] = array_merge($en,$default) ;
		}
	}
	
	function setApp($app=null){
		if(!$app) return false;
		$GLOBALS["currentApp"] = $app;
	}
	
	function _($text=null, $app = null){
		$app = $app ? $app : $GLOBALS["currentApp"];
		if(!$app) return $text;
		if(isset($GLOBALS["apptext"][$app][$text])){
			return $GLOBALS["apptext"][$app][$text];
		}else return $text;
	}
	
	function out($text=null, $app=null){
		echo AText::_($text,$app);
	}
}
	   

?>