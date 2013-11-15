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

  define("M4J_NOBAR",1);
  global $m4jConfig_live_site, $m4j_lang_elements;
  
  remember_cid();
  
  $app = JRequest::getWord("app",null);
  
  if(!$app) m4jRedirect(M4J_APPLIST.M4J_REMEMBER_CID_QUERY);
  
  include_once (M4J_INCLUDE_EDIT_AREA);
  $GLOBALS['editArea'] = new EditArea();

  require_once(M4J_INCLUDE_VALIDATE);
  require_once(M4J_INCLUDE_FUNCTIONS);
  // Special text class for apps
  require_once(M4J_INCLUDE_APPTEXT);
  require_once(M4J_INCLUDE_APPHELPER);
  require_once(M4J_INCLUDE_APPDB);
  
  jimport('joomla.filesystem.file');
  jimport('joomla.filesystem.folder');
  jimport('joomla.filesystem.path');

  AText::setApp($app);
  $error = "";

ob_start();  
if($app){
	// include MVC
	require_once(M4J_INCLUDE_CONTROLLER);
  	require_once(M4J_INCLUDE_VIEW);
  	require_once(M4J_INCLUDE_MODEL);
	
	
	// App view processing
	if(JFile::exists(M4J_APPS_BASE. $app . DS ."admin" . DS . "controller.php" )){
		$className = "App" . ucfirst(strtolower($app));
		include_once (M4J_APPS_BASE. $app . DS ."admin" . DS . "controller.php");
		
		if(class_exists($className) && get_parent_class($className)== "MController" ){
			$controller = new $className($app,1);
			$controller->render();
		}else{
			JError::raiseError( 404, "App " . JText::_("NOT FOUND") );
		}
	}	
}else{
	
}
$puffer = ob_get_clean();

// Render into Proform's window  
HTML_m4j::head(M4J_ADMINAPPS,$error);

echo $puffer;

HTML_m4j::footer();
			
$app = null;

?>
