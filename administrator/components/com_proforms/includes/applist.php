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

define("M4J_NOBAR",0);
remember_cid();
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.registry.format');
$format = JRegistryFormat::getInstance("ini");


include_once (M4J_INCLUDE_EDIT_AREA);
require_once(M4J_INCLUDE_VALIDATE);
require_once(M4J_INCLUDE_FUNCTIONS);

// Special text class for apps
require_once(M4J_INCLUDE_APPTEXT);
require_once(M4J_INCLUDE_APPHELPER);
require_once(M4J_INCLUDE_APPDB);

$aid = JRequest::getInt("aid",null);
$active = JRequest::getInt("active",-1);
$sort_order = JRequest::getInt("sort_order",0);
$message = (isset($_REQUEST["success"])) ? M4J_LANG_APPINSTALL_SUCCESS : null;
$message = (isset($_REQUEST["removed"])) ? M4J_LANG_APPUNINSTALL_SUCCESS : $message;

if(JRequest::getInt("install", null)){
	require_once (M4J_INCLUDE_INSTALL);
	$installer = new MInstaller();
	if($installer->success) m4jRedirect(M4J_APPLIST.M4J_REMEMBER_CID_QUERY."&success=1");
}


if($aid && $active > -1){
	$active = $active ? 1 : 0;
	MDB::update("#__m4j_apps" ,array("active" => $active),MDB::_("aid",$aid));	
}

switch($task){
	case 'up':
			if($sort_order)
			{
				$query = "SELECT `aid`, `sort_order` FROM `#__m4j_apps` WHERE `sort_order` < ". $sort_order ." ORDER BY `sort_order` DESC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows){
					$prev_id = $rows[0]->aid;
					$prev_sort_order = $rows[0]->sort_order;
					if($id){
							$query = "UPDATE `#__m4j_apps`"
							. "\n SET"
							. "\n `sort_order` = '".$prev_sort_order."' "
							. "\n WHERE `aid` = '".$id."' ";
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							
							$query = "UPDATE `#__m4j_apps`"
							. "\n SET"
							. "\n `sort_order` = '".$sort_order."' "
							. "\n WHERE `aid` = '".$prev_id. "' ";
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							
							m4jRedirect(M4J_APPLIST.M4J_REMEMBER_CID_QUERY);
						}//EOF $id exist
					 }//EOF $rows exist	
			}//EOF $sort_order exist
		break; 
	
	
		case 'down':
			if($sort_order)
			{
				$query = "SELECT `aid`, `sort_order` FROM `#__m4j_apps` WHERE `sort_order` > ". $sort_order ." ORDER BY `sort_order` ASC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows)
						{
						$next_id = $rows[0]->aid;
						$next_sort_order = $rows[0]->sort_order;
						if($id)
							{
								$query = "UPDATE `#__m4j_apps`"
								. "\n SET"
								. "\n `sort_order` = '".$next_sort_order."' "
								. "\n WHERE `aid` = '".$id. "' ";
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
								
								$query = "UPDATE `#__m4j_apps`"
								. "\n SET"
								. "\n `sort_order` = '".$sort_order."' "
								. "\n WHERE `aid` = '".$next_id."' ";
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
								
								m4jRedirect(M4J_APPLIST.M4J_REMEMBER_CID_QUERY);
							}//EOF $id exist
						 }//EOF $rows exist	
			}//EOF $sort_order exist
		break; 
		
		case 'uninstall':
			if($aid){
				
				require_once (M4J_INCLUDE_UNINSTALL);
				
				$uninstall = new MUninstaller("app", $aid);
				if($uninstall->success) m4jRedirect(M4J_APPLIST.M4J_REMEMBER_CID_QUERY."&removed=1");				
			}	
		break;
		
	
}





$uri = M4J_APPLIST.M4J_REMEMBER_CID_QUERY;


$db = & JFactory::getDBO();
$query = "SELECT * FROM `#__m4j_apps` ORDER BY `sort_order` ASC "; 
$db->setQuery($query);
$applications = $db->loadObjectList();
// Building the App Menu
$appInfo = array();
  
foreach($applications as $application){
  AText::add($application->app);
  $infoObject = $format->stringToObject($application->info);
  $info = new stdClass();
  $info->name = AText::_("name",$application->app);
  $info->desc = AText::_("desc",$application->app);
  $info->hasAdmin = $application->has_admin_view;
  $info->hasView = $application->has_view;
  $info->hasPlugin = $application->has_plugin;
  $info->created = $application->created;
  $info->active = $application->active;
  $info->aid = $application->aid;
  $info->app = $application->app;
  $info->author = $infoObject->author;
  $info->version = $infoObject->version;
  $info->sort_order = $application->sort_order;
  $info->additionalInfo = "<b>Copyright:</b><br>" . $infoObject->copyright . "<br>" . "<b>License:</b><br>". $infoObject->license; 
  
  array_push($appInfo, $info);
}
  
$error = "";		

	
// Display config	  
HTML_m4j::head(M4J_APPLIST);
 	$args = array("heading"=>M4J_LANG_APPS, "error"=>$error, "appInfo" => $appInfo , "uri" => $uri, "message" => $message);
 	echo MTemplater::get(M4J_TEMPLATES."applist.php",$args);
HTML_m4j::footer();

?>
