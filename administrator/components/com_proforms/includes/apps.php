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

  global $m4jConfig_live_site, $m4j_lang_elements;
  
  remember_cid();
  if($id==-1) m4jRedirect(M4J_JOBS.M4J_REMEMBER_CID_QUERY);
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

  $app = JRequest::getWord("app",null);
  $isSend = JRequest::getInt("send",0);
  $activestate = JRequest::getInt("appactivestate", 0);
  
  AText::setApp($app);
  
  $job = MDB::get("#__m4j_jobs",null,MDB::_("jid",$id),"LIMIT 1");
  $job = $job ? $job[0] : null;
  if(!$job) m4jRedirect(M4J_JOBS.M4J_REMEMBER_CID_QUERY);
  
  
  $formName = $job->title;
  $fids = explode(",",$job->fid);
  
  $formElementsJS = "\nvar formElements = {\n\t";
  $eids = array();
  $elementsArray = array();
  $usermail = 0;
  foreach($fids as $fid){
  	$elements = MDB::get("#__m4j_formelements",null,MDB::_("fid",$fid),"ORDER BY `slot`,`sort_order` ");
  	foreach($elements as $element){
  		
  		$params = parameters($element->parameters);
  		$use_values = (isset($params["use_values"])) ? $params["use_values"] : 0;
  		
  		// Check for options
  		$jsOptions = "";
  		// Check options for selection
  		if ($element->form >= 30 && $element->form < 40){
	  		if (strpos($element->options, "\n") !== false){
	  			$opts = explode("\n", $element->options);
	  			$options = explode(";",$opts[0]); $values = explode(";",$opts[1]);
	  			$optSize = sizeof($options);
	  			$optArray = array();
	  			for($t=0; $t< $optSize; $t++){
	  				$val = $use_values ? ( isset($values[$t]) ? $values[$t] : null ) : $options[$t];
	  				$jso = '{text:"' . MReady::_($options[$t]) .'", value:"'. MReady::_($val) .'"}';
	  				array_push($optArray, $jso);
	  			}
	  			$jsOptions = "[" . implode(",", $optArray) ."]";	
	  		}else{
	  			if(!$element->options){
	  				$jsOptions = "null";
	  			}else{
	  				$opts = (substr($element->options, -1)== ";") ? substr($element->options, 0, -1) : $element->options;
	  				$options = explode(";",$opts); 
	  				$optSize = sizeof($options);
		  			$optArray = array();
		  			for($t=0; $t< $optSize; $t++){
		  				$jso = '{text:"' . MReady::_($options[$t]) .'", value:"'. MReady::_($options[$t]) .'"}';
		  				array_push($optArray, $jso);
		  			}
		  			$jsOptions = "[" . implode(",", $optArray) ."]";	
		  		}
	  		}
  		}else{
  			$jsOptions = "null";
  		}
  		
  		array_push($eids,$element->eid);
  		if($element->usermail) $usermail = $element->eid;
  		array_push($elementsArray, 
  			'"_'.$element->eid.'": {"form": '.$element->form.', "question": "'. MReady::_($element->question).'", "alias": "'. MReady::_($element->alias).'", "options": '. $jsOptions .'}');
  	}//EOF foreach elements
  }//EOF foreach fids
  $formElementsJS .= implode(",\n\t", $elementsArray) . "\n};";
  
  
  $document=& JFactory::getDocument();
  $langElementsArray = array();
  foreach($m4j_lang_elements as $key => $value){
  	array_push($langElementsArray, '"_'.$key.'" : "'.MReady::_($value).'"' );
  }
 
  $document->addScriptDeclaration("\nvar elementTitles = {\n\t".implode(",\n\t", $langElementsArray)."\n};");
  $document->addScriptDeclaration("\nvar eids = [".implode(",", $eids)."];");
  $document->addScriptDeclaration("\nvar uniqueEmail= $usermail ;");
  $document->addScriptDeclaration("\nvar M4J_IMAGES= \"".M4J_IMAGES."\" ;");
  $document->addScriptDeclaration($formElementsJS);	
//   
//  $document->addScriptDeclaration("\n console.log(formElements);");
  
  $db = & JFactory::getDBO();
  
  $query = "SELECT `a`.`app`, `aj`.`active` FROM `#__m4j_apps` AS `a`
			LEFT JOIN 
			(SELECT `app`, `active` FROM `#__m4j_apps2jobs` WHERE `jid` = '$id') AS `aj` ON `a`.`app` = `aj`.`app`
			WHERE `a`.`active` = '1' 
			ORDER BY `a`.`sort_order` ASC "; 
  
  $db->setQuery($query);
  $applications = $db->loadObjectList();
  
  // Building the App Menu
  $appInfo = array();
	  
  foreach($applications as $application){
  	AText::add($application->app);
  	$info = new stdClass();
  	$info->name = AText::_("name",$application->app);
  	$info->desc = AText::_("desc",$application->app);
  	$info->app = $application->app;
  	$info->active = ($isSend && ($app == $application->app ) ) ? $activestate :  (int) $application->active;
  	array_push($appInfo, $info);
  }
  
  //Error var
  $error = "";
  // the mainframe data object
  $self = new stdClass();
  $self->name = $app;
  $self->uri =  M4J_APPS.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY."&amp;id=". $id . "&amp;app=".$app;
  $self->base = M4J_APPS_BASE.$app.DS; 
  $self->includes = M4J_APPS_BASE.$app.DS."includes";
  $self->HTTP = M4J_HTTP_APPS.$app."/"; 
  $self->CSS = M4J_HTTP_APPS.$app."/css/"; 
  $self->images = M4J_HTTP_APPS.$app."/images/"; 
  $self->JS = M4J_HTTP_APPS.$app."/js/"; 
  
  //App DB
  $appdb = new AppDB($app , $id);
  $appdb->load();
  
  // Create GUI from parameters if xml exists
  $prmo = new AppParameters($self, $appdb->paramsIfLoad() );
  
  // Get the GUI from App
  $appBody = null;
  if(JFile::exists($self->base .$app . ".php" )){
  	ob_start();
  		include_once ($self->base .$app . ".php");
  	$appBody = ob_get_clean();
  }else{
  	ob_start();
  		include_once (M4J_APPS_PARAMS);
  	$appBody = ob_get_clean();
  }
  
  // Get outside form
  $outsideForm = null;
  if(JFile::exists($self->base .$app . ".noform.php" )){
  	ob_start();
  		include_once ($self->base .$app . ".noform.php");
  	$outsideForm = ob_get_clean();
  }
  
  
  
  
  // Render into Proform's window
  HTML_m4j::head(M4J_APPS,$error);
     
   $args = array(
   		"id"=> $id,
   		"formName"=> $formName,
   		"app"=> $app,
   		"appactivestate" => $appdb->status,
   		"appInfo" => $appInfo,
   		"appBody" => $appBody,
   		"outsideForm" => $outsideForm
   );
   
   echo MTemplater::get(M4J_TEMPLATES."apps.php",$args);

HTML_m4j::footer();
$app = null;
?>
