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
 
  remember_cid();
 

  require_once(M4J_INCLUDE_VALIDATE);
  require_once(M4J_INCLUDE_FUNCTIONS);
  
  $error= null;
  $name= JRequest::getString('name',null);
  $alias = JRequest::getString('alias',null);
  $email= JRequest::getString('email',null);
  $access = JRequest::getInt('access',0);
  $active = JRequest::getInt('active',1);
  $intro = JRequest::getString('intro', null, 'default', JREQUEST_ALLOWHTML);	

  $legal_email = $validate->multipleEmail($email);


  $max_sort = null;
		$query = "SELECT MAX(sort_order) AS max_sort FROM #__m4j_category";

		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		$max_sort = $rows[0]->max_sort;

$apply = 0;		
if("apply_new" == $task){
	$task = "new";
	$apply = 1;
}else if("apply" == $task){
	$task = "update";
	$apply = 1;
}


	switch($task)
	{
	
		case 'new':
			if($name!=null && ($legal_email|| $email==null) ){
				$query = "INSERT INTO #__m4j_category"
						. "\n ( `name`, `alias`, `active`, `email`, `introtext` , `access`, `sort_order` )"
						. "\n VALUES"
						. "\n ( '".$database->getEscaped($name)."', '".$database->getEscaped($alias). "', '". $active."', '".$email."', '".$database->getEscaped($intro)."', '". $access ."', '".($max_sort+1)."' )";
				
				$database->setQuery($query);
				if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
				
				$insertId = $database->insertid();
				$sef = new MSEF($name,$alias,null,$insertId);
				$sef->insert();	
					
				if($apply){
					m4jRedirect(M4J_CATEGORY_NEW."&id=".$insertId.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.M4J_EDIT);
				}else{
					m4jRedirect(M4J_CATEGORY.M4J_REMEMBER_CID_QUERY);
				}
			}else{
				  if(!$legal_email && $email!=null) $error = M4J_LANG_NONE_LEGAL_EMAIL;
				  if(!$name) $error .= M4J_LANG_CATEGORY_NAME_ERROR;
			}	
		break;
		//EOF NEW
		

		case 'edit':
			if($id!=null)
			{
				$query = "SELECT * FROM #__m4j_category WHERE cid = ".$id;
				$database->setQuery( $query );
				$rows = $database->loadObjectList();
				  $name= MReady::_($rows[0]->name);
				  $alias = MReady::_($rows[0]->alias);
  				  $email= $rows[0]->email;
  				  $access = intval($rows[0]->access);
  				  $active = intval($rows[0]->active);
				  $intro = 	MReady::_($rows[0]->introtext);
			}
		break;
		//EOF EDIT
	
		case 'update':
		$editID = JRequest::getInt('editID',null);
		if($name!=null && ($legal_email|| $email==null) && $editID){
			
			$database->setQuery("SELECT `name`,`alias` FROM #__m4j_category WHERE `cid` = '".(int) $editID."'");
			$old = $database->loadObjectList();	
			$newSef = false;
			
			if(!$old) {
				$newSef= true;
			}else{
				if($alias){
					if($alias != $old[0]->alias){
						$newSef = true;
					}
				}else{
					if($name != $old[0]->name){
						$newSef = true;
					}
				}	
			}
			
				
			$query = "UPDATE #__m4j_category"
				. "\n SET"
				. "\n `active` = '".$active."', "
				. "\n `name` = '".$database->getEscaped($name)."', "
				. "\n `alias` = '".$database->getEscaped($alias)."', "
				. "\n `email` = '".$email."', "
				. "\n `access` = '".$access."', "
				. "\n `introtext` = '".$database->getEscaped($intro)."'"
				. "\n WHERE `cid` = ".$editID;
				$database->setQuery($query);
				if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
				
				if($newSef){
					$sef = new MSEF($name,$alias,null,$editID);
					$sef->update();
				}
				
				if($apply){
					m4jRedirect(M4J_CATEGORY_NEW."&id=".$editID.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.M4J_EDIT);
				}else{	
			 		m4jRedirect(M4J_CATEGORY.M4J_REMEMBER_CID_QUERY);
				}
		}else{
			if(!$legal_email && $email!=null) $error = M4J_LANG_NONE_LEGAL_EMAIL;
			if(!$name) $error .= M4J_LANG_CATEGORY_NAME_ERROR;
			define("M4J_EDITFLAG",1);
			$id = $editID;
		}	
		break;
		//EOF UPDATE
		
		default:
		$active = 1;
		break;
	}	
	
	
	
	
	
  HTML_m4j::head(M4J_CATEGORY_NEW,$error);
  	if(M4J_EDITFLAG==1) $helpers->caption(M4J_LANG_EDIT_CATEGORY,null,M4J_LANG_CATEGORY.' > '.M4J_LANG_EDIT);
	else $helpers->caption(M4J_LANG_NEW_CATEGORY,null,M4J_LANG_CATEGORY.' > '.M4J_LANG_NEW_CATEGORY);	
	  
  HTML_m4j::new_category($name,$alias,$email,$id,$active,$intro,$access); 
   
  HTML_m4j::footer();
	
	
?>