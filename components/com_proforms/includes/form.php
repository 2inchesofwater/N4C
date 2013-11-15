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

$query = "SELECT *  FROM #__m4j_jobs WHERE `jid` = '".$jid."'  AND `active` = '1' LIMIT 1";
$database->setQuery( $query );
$rows = $database->loadObject();

	
// include app plugin main classes
require_once(M4J_INCLUDE_PLUGINMANAGER);
require_once(M4J_INCLUDE_PLUGIN);
// App Plugin Init
require_once(M4J_INCLUDE_APPS);		

$pluginManager->applyJobsReference($rows);

// render stylesheet
$print->stylesheet();

if($rows){

	if( ! M4J_validate::access($rows->access) ){
		  	  	JError::raiseError( 403, JText::_("ALERTNOTAUTH") );	
	}
	
	// NEW FID
	$fid = null;
	if($rows->fid != ""){
		$fid = (int) $rows->fid;
	}else{
		//Cancel because of no form template is assigned 
		echo '<div class ="'.M4J_CLASS_ERROR.'">'.M4J_LANG_ERROR_NO_TEMPLATE.'</div>';
		return;
	}
	//	$rows->fid = (int) $fid[0];

	if($rows->captcha==1) define('M4J_IS_CAPTCHA',true);
	else define('M4J_IS_CAPTCHA',false);

	metaTitle(MReady::_($rows->title));
	if(M4J_FORM_TITLE){
		$print->heading(MReady::_($rows->title));
	}
	$print->headertext($rows->maintext);

	// Check if there are required Elements for printing an advice
	if(isset($rows->fid)){
		checkRequired($rows->fid);		
	}
	// Writing the form head tag
	$print->form_head(null,$jid,$jid,$rows->cid);
	
	// Element ID Heap
	$eidHeap = array();
	
	$formTemplateCount = 0;
	$usermail = false;
	$f = $fid;
	
		$query = "SELECT *  FROM #__m4j_forms WHERE fid = '".$f."'";
		$database->setQuery( $query );
		$form = $database->loadObjectList();

		$GLOBALS['M4J_USE_HELP'] = ($form[0]->use_help==1) ? 1 : 0 ;
		// Layout
		$layout = MLayoutList::get('layout01');
		$layout->addData(MLayoutList::makeData($form[0]->layout_data));
		$layout->setHelp($form[0]->use_help);
		$layout->reset();


		if($form){
			$query = "SELECT * FROM #__m4j_formelements WHERE `fid`='".$f."' AND `active` = '1' ORDER BY `slot`,`sort_order` ASC";
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			
			
			foreach ($rows as $row){
				
			//Add eid to eid heap	
			array_push($eidHeap, $row->eid);
			
				
				$option_count = sizeof(explode(';',$row->options))-1;
				if($option_count==-1) $option_count=null ;

				$html = $row->html;
				switch($row->form){
					case 1:
						break;

					case 2:
						$html = $print->replace_yes_no($html);
						break;

					case ($row->form>=10 && $row->form<30):
						$html = str_replace('{'.$row->eid.'}', '', $html);
						break;

					case ($row->form>=30 && $row->form<40):
						if($option_count)
						{
							for($t=0;$t<$option_count;$t++)
							$html= str_replace('{'.$row->eid.'-'.$t.'}', '', $html);
						}
						break;
				} // EOF switch
				
				
				// ++++++++++++++++++++++++++
				// Append html to Layout Slot
				// ++++++++++++++++++++++++++

				if($row->form>=50 && $row->form<60){
				}else{
					$isHidden = ($row->form == 23) ? 1 : 0;
					$layout->addRow($row->slot,$row->question,stripslashes($html),$row->required,$row->help,$row->align,0,$row->eid,$isHidden);
				}

			}//EOF foreach
			$layout->render(true);

			$formTemplateCount++;
		}else {
			$print->error_no_form();
		}

	//EID HEAP to JS
	$proformsJSFields="\t var pfmFields = [" .implode(",", $eidHeap)."];\n";
	$document->addScriptDeclaration($proformsJSFields);
	
	//App Plugin at form footer
	echo $pluginManager->formFooter();
		
	//* CAPTCHA
	if(M4J_IS_CAPTCHA){
		purge_captcha();
		$captcha = random_string();
		$proceed = true;
		$user = null;
		while($proceed){
			$user = random_string(32);
			$query = "SELECT COUNT(*) as `count`  FROM #__m4j_captcha WHERE user= '".$user."'";
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			if($rows[0]->count == 0) $proceed = false;
		}
		$query = "INSERT INTO #__m4j_captcha"
		. "\n ( date, user, captcha )"
		. "\n VALUES"
		. "\n ( CURRENT_TIMESTAMP, '".$user."', '".$captcha."' )";
		$database->setQuery($query);
		if (!$database->query()) $print->dbError($database->getErrorMsg());
		
		
		
		$print->form_footer($print->captcha($user),null);

	}else {
		$print->form_footer(null,null);
	}//EOF CAPTCHA
	
	if($formTemplateCount == 0) $print->error_no_form();

}//EOF IF $rows
else {
	$print->error_no_form();
}

?>