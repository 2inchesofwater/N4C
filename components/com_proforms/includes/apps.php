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
	
//APPS Processing

$pluginManager = null;	
	
if($app){
	
	 $jid = JRequest::getInt('jid',null);
	 $db = & JFactory::getDBO();
	 $escApp = $db->getEscaped($app);
     $query = "SELECT `a`.`app` FROM `#__m4j_apps` AS `a`
			LEFT JOIN 
			(SELECT `app`, `active` FROM `#__m4j_apps2jobs` WHERE `jid` = '$jid') AS `aj` ON `a`.`app` = `aj`.`app`
			WHERE `a`.`active` = '1' AND `aj`.`active` = '1' AND `a`.`has_view` = '1' AND `a`.`app` = '$escApp' LIMIT 1";

    $db->setQuery($query);
    $dba = $db->loadObject();
	
	// App view processing
	if(JFile::exists(M4J_APPS_BASE. $app . DS . "controller.php" ) && $dba){
		$className = "App" . ucfirst(strtolower($app));
		include_once (M4J_APPS_BASE. $app . DS . "controller.php");
		
		if(class_exists($className) && get_parent_class($className)== "MController" ){
			$controller = new $className($app);
			$controller->render();
		}else{
			JError::raiseWarning(1, 'Proforms Apps: ' . JText::_("METHOD NOT FOUND") );			
		}
	}else{
		if(! JFile::exists(M4J_APPS_BASE. $app . DS . "controller.php" )){
			JError::raiseWarning(1, 'Proforms Apps: ' . JText::_("CANNOT FIND SOURCE FILE") );
		}else{
			
			JError::raiseWarning(1, 'Proforms Apps: ' . JText::_("PAGE COULD NOT BE FOUND") );
		}
				
	}	
}else{
	// App plugin processing
	$db = & JFactory::getDBO();
	$query = "SELECT `a`.`app`, `aj`.`params` FROM `#__m4j_apps` AS `a`
			  LEFT JOIN `#__m4j_apps2jobs`AS `aj` ON `a`.`app` = `aj`.`app`
			  WHERE `a`.`active` = '1' AND `aj`.`active` = '1' AND `a`.`has_plugin` = '1'  AND `aj`.`jid` = '$jid'";
	$db->setQuery($query);
	$checkPlugins = $db->loadObjectList();
	
	$pluginManager = & AppPluginManager::getInstance();
	$pluginManager->setJID($jid);
	if($checkPlugins){
		foreach($checkPlugins as $check){
			$pluginManager->add($check->app, $check->params);
		}//EOF plugin check
	}
	$pluginManager->analyseStop();
	$pluginManager->analyseForceTmpDelete();
//	$pluginManager->debug();
	
}//EOF App plugin processing	
	

	

?>