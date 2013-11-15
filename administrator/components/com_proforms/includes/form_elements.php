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
  $slot = JRequest::getInt('slot',1);
  if($id==-1) m4jRedirect(M4J_FORMS);
  include_once(M4J_INCLUDE_FUNCTIONS);
  include_once(M4J_INCLUDE_FORMFACTORY);
  
  $alias= JRequest::getInt("alias",0); 
  
  $mainframe =& JFactory::getApplication();
  $rememberAlias = $mainframe->getUserState("m4jShowAliasFE".$id);
  if(!isset($_REQUEST["alias"])){
  	if($rememberAlias) $alias = $rememberAlias;
	else $mainframe->setUserState("m4jShowAliasFE".$id, $alias);
  }else{
	$mainframe->setUserState("m4jShowAliasFE".$id, $alias);
  }
  define("M4J_SHOW_ALIAS", $alias);
  
  
  
  $template_name = '';	
  $eid = m4jGetParam( $_REQUEST,'eid');
  $sort_order = m4jGetParam($_REQUEST, 'sort_order');
  $query = "SELECT * FROM #__m4j_forms WHERE fid = ".$id;
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
  if($rows[0]->question_width==null) $rows[0]->question_width = 450;				
  if($rows[0]->answer_width==null) $rows[0]->answer_width = 450;
  				
  define('M4J_TABLE_QWIDTH',intval($rows[0]->question_width));
  define('M4J_TABLE_AWIDTH',intval($rows[0]->answer_width));
  define('M4J_PREV_TABLE',(M4J_TABLE_QWIDTH+M4J_TABLE_AWIDTH));
  
  
  
  
  switch($task)
	{
		case 'delete':
			if($eid)
					{
					$query = "DELETE FROM #__m4j_formelements WHERE eid = ".$eid;
					$database->setQuery($query);
					if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
					
					MDB::refactorOrder("#__m4j_formelements", MDB::_(array("slot"=>$slot,"fid"=>$id)));
					
					}
		 break;
		 
		case 'up':
			if($sort_order)
			{
				$query = "SELECT * FROM #__m4j_formelements WHERE fid = '".$id."' AND `slot` = '".$slot."' AND sort_order < ". $sort_order ." ORDER BY sort_order DESC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows)
					{
					$prev_id = $rows[0]->eid;
					$prev_sort_order = $rows[0]->sort_order;
					if($eid)
						{
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n sort_order = ".$prev_sort_order." "
							. "\n WHERE eid = ".$eid;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n sort_order = ".$sort_order." "
							. "\n WHERE eid = ".$prev_id;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}//EOF $eid exist
					 }//EOF $rows exist	
			}//EOF $sort_order exist
			
			m4jRedirect(M4J_FORM_ELEMENTS."&nobar=1&id=".$id."&slot=".$slot.M4J_REMEMBER_CID_QUERY);
		break; 
	
	
		case 'down':
			if($sort_order)
			{
				$query = "SELECT * FROM #__m4j_formelements WHERE fid = '".$id."' AND `slot` = '".$slot."' AND sort_order > ". $sort_order ." ORDER BY sort_order ASC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows)
						{
						$next_id = $rows[0]->eid;
						$next_sort_order = $rows[0]->sort_order;
						if($eid)
							{
								$query = "UPDATE #__m4j_formelements"
								. "\n SET"
								. "\n sort_order = ".$next_sort_order." "
								. "\n WHERE eid = ".$eid;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
								
								$query = "UPDATE #__m4j_formelements"
								. "\n SET"
								. "\n sort_order = ".$sort_order." "
								. "\n WHERE eid = ".$next_id;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							}//EOF $eid exist
						 }//EOF $rows exist	
			}//EOF $sort_order exist
			m4jRedirect(M4J_FORM_ELEMENTS."&nobar=1&id=".$id."&slot=".$slot.M4J_REMEMBER_CID_QUERY);
		break; 
	
		case'publish':
		if($eid)
						{
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n active = 1 "
							. "\n WHERE eid = ".$eid;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}
		break;
		
		case'unpublish':
		if($eid)
						{
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n active = 0 "
							. "\n WHERE eid = ".$eid;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}
		break;	
		
		case'required':
		if($eid)
						{
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n required = 1 "
							. "\n WHERE eid = ".$eid;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg());
							
							$query = "SELECT * FROM #__m4j_formelements WHERE `eid` = '".$eid."'";
							$database->setQuery( $query );
							$formElement = $database->loadObject();
							
							if($formElement->form >=20 && $formElement->form <30){
								$parameters = parameters($formElement->parameters);
								$eval = "";
								$evalRequired = $eval + 1000;
								if($eval == 0) {
									if($formElement->form == 21){
										$eval="0";
									}else {
										$eval = "";
									}
								}
								
								$formElement->html = str_replace('alt="'.$eval.'"','alt="'.$evalRequired.'"',$formElement->html);
								$formElement->html = str_replace('lang="'.$eval.'"','lang="'.$evalRequired.'"',$formElement->html);
								
							}else{
								$formElement->html = str_replace('alt=""','alt="1000"',$formElement->html);
								$formElement->html = str_replace('lang=""','lang="1000"',$formElement->html);
								$formElement->html = str_replace('lang="0"','lang="1000"',$formElement->html);
							}
							
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n html = '".$database->getEscaped($formElement->html)."' "
							. "\n WHERE eid = ".$eid;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg());
						}
		break;
		
		case'not_required':
		if($eid)
						{
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n required = 0 "
							. "\n WHERE eid = ".$eid;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg());

							$query = "SELECT * FROM #__m4j_formelements WHERE `eid` = '".$eid."'";
							$database->setQuery( $query );
							$formElement = $database->loadObject();
							
							if($formElement->form >=20 && $formElement->form <30){
								
								$parameters = parameters($formElement->parameters);
								$eval = "";
								$evalRequired = $eval + 1000;
								if($eval == 0) {
									if($formElement->form == 21){
										$eval="0";
									}else {
										$eval = "";
									}
								}
								
								$formElement->html = str_replace('alt="'.$evalRequired.'"','alt="'.$eval.'"',$formElement->html);
								$formElement->html = str_replace('lang="'.$evalRequired.'"','lang="'.$eval.'"',$formElement->html);
								
							}else{
								$formElement->html = str_replace('alt="1000"','alt=""',$formElement->html);
								$formElement->html = str_replace('lang="1000"','lang=""',$formElement->html);
								$formElement->html = str_replace('lang="1000"','lang="0"',$formElement->html);
							}
							
							$query = "UPDATE #__m4j_formelements"
							. "\n SET"
							. "\n html = '".$database->getEscaped($formElement->html)."' "
							. "\n WHERE eid = ".$eid;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg());
						}
		break; 
		
	  case'copy':
	  if($eid){
	  			$newId = MDB::copyPlus("#__m4j_formelements", MDB::_("eid",$eid), MDB::_(array("fid"=>$id, "slot"=>$slot),MDB_AND) );
	  			MDB::refactorFE($eid,$newId);
	  }
	  break;
		
		
	}	

  
  
  		
	  
HTML_m4j::head(M4J_FORM_ELEMENTS);
  
  HTML_m4j::form_elements_table_head(); 

   // DB Query Getting the Name of the Template
		$query = "SELECT * FROM #__m4j_forms WHERE fid = ".$id;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		if($rows) $template_name = $rows[0]->name;
		
		$helpers->caption(M4J_LANG_TEMPLATE_ELEMENTS.$helpers->span(MReady::_($template_name),'m4j_green'),null,M4J_LANG_TEMPLATES.' > '.M4J_LANG_ITEMS);
	
		// SLOT TABS
		HTML_m4j::slotTabs('layout01',1);
		
		// Table Header Alias or Question
		if(M4J_SHOW_ALIAS === 0){
		$aliasSwitch = M4J_LANG_QUESTION ." ( " . JText::_("Alias") ." )" . 
						'<div class="m4jFESwitchAliasWrap"><a href="'.M4J_FORM_ELEMENTS.'&id='.$id.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.
						'&alias=1" class="m4jQuestionAliasSwitchFE" info="'.M4J_LANG_USE_ALIAS_DESC_FE.'">'.M4J_LANG_USE_ALIAS.'</a></div>';

		}else{
		$aliasSwitch = JText::_("Alias") ." ( " . M4J_LANG_QUESTION ." )". 
					   '<div class="m4jFESwitchAliasWrap"><a href="'.M4J_FORM_ELEMENTS.'&id='.$id.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.'&alias=0" 
   						class="m4jQuestionAliasSwitchFE"  info="'.M4J_LANG_USE_QUESTIONS_DESC_FE.'">
   						'.M4J_LANG_USE_QUESTIONS.'</a></div>';
		}
		
		
		
		
	    $head = array( M4J_LANG_ACTIVE , M4J_LANG_REQUIRED ,$aliasSwitch , M4J_LANG_TYPE ,'eid', M4J_LANG_POSITION, '', '' , '' );
	    $helpers->init_table($head);
	  
	  	// DB Query Drawing the Table
		$query = "SELECT * FROM #__m4j_formelements WHERE fid = ".$id." ORDER BY slot, sort_order ASC";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
	
		$even=true;
		foreach($rows as $row){
		
		    $widthArray = array('16px', '16px', '','150px','25px','45px','16px','16px','16px');
		    $requiredButton = $helpers->required_button(M4J_FORM_ELEMENTS,$id,$row->required,1,$row->eid);
		    if($row->usermail){
		    	$requiredButton = $helpers->usermail_button();
		    }
		    if($row->form>=50 && $row->form<60) $requiredButton = '';
		    
		    // Show question or alias
			if(M4J_SHOW_ALIAS === 0){
		    	$question = ( trim($row->question) != "" ) ? $row->question : $row->alias;
			}else{
		    	$question = ( trim($row->alias) != "" ) ? $row->alias : $row->question;
			}
		    
		    $maxQuestionSize = M4J_WORKAREA-311;
		    $maxChars = round($maxQuestionSize/12);
		    if(strlen($question)>$maxChars){
		    	$question = substr($question,0,($maxChars-3)). "...";
		    }
		    
			$rowArray = array (
								$helpers->active_button(M4J_FORM_ELEMENTS,$id,$row->active,1,$row->eid),
								$requiredButton,
								$helpers->element_edit_by_name($question,M4J_ELEMENT.'&template_name='.$template_name,$id,$row->eid,$row->form),
								$m4j_lang_elements[$row->form],
								$row->eid,
								$helpers->element_up_down_button(M4J_FORM_ELEMENTS,$id,$row->eid,$row->sort_order),
								$helpers->copy_button(M4J_FORM_ELEMENTS,$id,M4J_LANG_DO_COPY,M4J_HIDE_BAR,$row->eid),
								$helpers->element_delete_button(M4J_FORM_ELEMENTS,$id,$row->eid),
								$helpers->element_edit_button(M4J_ELEMENT.'&template_name='.$template_name,$id,$row->eid,$row->form,M4J_LANG_EDIT)	
							  );
				$class = 'rowSlot'.$row->slot;
				$helpers->table_row($rowArray,$even,$widthArray,$class, ($row->slot == $slot) );
				$even = !$even; 
				
		} //EOF foreach
		//EOF DB Query	

	  $helpers->close_table();
  	  if(M4J_SHOW_LEGEND) HTML_m4j::legend('formelements');	
  HTML_m4j::form_elements_menu($id,$template_name);	   
HTML_m4j::footer(true);
  
echo '<script type="text/javascript">';
echo 'var previewLink = "'.(M4J_PREVIEW. (int) $_REQUEST['id']).'";'."\n";
echo '</script>'."\n";
echo '<script src="'.M4J_JS_LAYOUT_SLOT.'" type="text/javascript"></script>'."\n"
		
		
  
?>
