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


$query = "SELECT * FROM `#__m4j_jobs` WHERE `jid` = '".$jid."'  AND `active` = '1' LIMIT 1";
$database->setQuery( $query );
$jobs = $database->loadObject();


// include app plugin main classes
require_once(M4J_INCLUDE_PLUGINMANAGER);
require_once(M4J_INCLUDE_PLUGIN);
// App Plugin Init
require_once(M4J_INCLUDE_APPS);		

$pluginManager->applyJobsReference($jobs);

// render stylesheet
$print->stylesheet();



// Redirect Home if job doesen't exist
if(!$jobs){
	m4jRedirect( $m4jConfig_live_site );
}else{
	if( ! M4J_validate::access($jobs->access) ){
		  	  	JError::raiseError( 403, JText::_("ALERTNOTAUTH") );	
	}
}

//NEW FID
$fids = null;
if(isset($jobs->fid)){
	$fids =(int) $jobs->fid;
}

// Checking captcha usage
if($jobs->captcha==1) define('M4J_IS_CAPTCHA',true);
else define('M4J_IS_CAPTCHA',false);

// set some variables
$upload_heap = NULL;
$error = null;

// Append Meta Title
metaTitle(MReady::_($jobs->title));

//* VALIDATE CAPTCHA
if(M4J_IS_CAPTCHA && ! $GLOBALS["proforms_is_human"])
{
	if(M4J_CAPTCHA =="CSS")
	{
		$user = m4jGetParam($_REQUEST, 'user');
		$validateCaptcha = m4jGetParam($_REQUEST, 'validate');
		$query = "SELECT COUNT(*) as hits FROM #__m4j_captcha WHERE user = '".$user."' AND captcha ='".$validateCaptcha."'";
		$database->setQuery( $query );
		$capture = $database->loadObjectList();
		if($capture[0]->hits==0) $error .= $print->add_error(M4J_LANG_ERROR_CAPTCHA);
		if(!$error)
		{
			$GLOBALS["proforms_is_human"] = $mf->setUserState( "proforms_is_human", 1 );
			
			$query = "DELETE FROM #__m4j_captcha WHERE user = '".$user."' AND captcha ='".$validateCaptcha."'";
			$database->setQuery($query);
			if (!$database->query()) $print->dbError($database->getErrorMsg());
		}
	}

	else if(M4J_CAPTCHA =="RECAPTCHA"){
		$resp = recaptcha_check_answer (RE_CAPTCHA_PRIVATE,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);
		if ( ! $resp->is_valid){
			$error .= $print->add_error(M4J_LANG_ERROR_CAPTCHA);
		}else{
			$GLOBALS["proforms_is_human"] = $mf->setUserState( "proforms_is_human", 1 );
		}
	}
	else
	{
		$mainframe =& JFactory::getApplication();
		$captcha_code= $mainframe->getUserState("m4j_captcha");
		$validateCaptcha = JRequest::getString("validate",null); 
		if($validateCaptcha != $captcha_code || $captcha_code == ""){
			$error .= $print->add_error(M4J_LANG_ERROR_CAPTCHA);
		}else{
			$GLOBALS["proforms_is_human"] = $mf->setUserState( "proforms_is_human", 1 );
		}
	}

}
//* EOF VALIDATE CAPTCHA


$values = array();

// create the storage
$storage = new Storage($jid,$fids);

// email routing process
$email = M4J_EMAIL_ROOT;
if($jobs->email) {
	$email = $jobs->email;
}else{
	$cat = MDB::get("#__m4j_category","email",MDB::_(array("cid"=>$jobs->cid,"active"=>"1")));
	if($cat && $cat[0]->email){
		$email = $cat[0]->email;
	}
}


	$fid = intval($fids);


	$query = "SELECT * FROM #__m4j_formelements WHERE `fid` = '".$fid."'  AND `active` = '1' ORDER BY `slot`,`sort_order` ASC";
	$database->setQuery( $query );
	$elements = $database->loadObjectList();

	//++++++++++++++++++++++++++++
	//Formelements Loop ++++++++++
	//++++++++++++++++++++++++++++

	foreach($elements as $element){	
		
		if($element->form != 40 ){
			// Formelement is not a file
			$value = m4jGetParam($_REQUEST, 'm4j-'.$element->eid, NULL);
		}else{
			// File
			$file = m4jGetParam( $_FILES, 'm4j-'.$element->eid , NULL );
			if($file) $value = $file['name'];
			else $value = NULL;
		}
			
		if ($value == NULL && ( $element->required==1) ){
			$error .= $print->add_error(M4J_LANG_MISSING.$element->question);
		}else{
			if($element->form == 1 || $element->form == 2){
				if((int) $value==1) $value = M4J_LANG_YES;
				else $value = M4J_LANG_NO;
			}
		}
						
		// Write value to values heap
		$values[$element->eid]= $value;

		// get parameters of the form element
		if($element->parameters !="") {
			$parameter = getParameters($element->parameters);
		}else {
			$parameter = null;
		}

					
		// Validate Attachement Upload

		if(intval($element->form) == 40 && isset($parameter) && $value != NULL)
		{
			// Check Ending
			if(! $ending = check_ending($file['name'],$parameter)) $error .= $print->add_error($element->question.M4J_LANG_WRONG_ENDING. str_replace("\n","",$parameter->endings));
			if(! $size = check_size($file['size'],$parameter))
			{
				$measure = "MB";
				switch (intval($parameter->measure))
				{
					case 1 : $measure = "B"; break;
					case 1024 : $measure = "KB"; break;
				}
				$error .= $print->add_error($element->question.M4J_LANG_TO_LARGE. $parameter->maxsize . " ".$measure);
			}
			if ($ending && $size) $upload_heap[] = 'm4j-'.$element->eid;
		}
		// EOF Validate Attachement Upload
		// adding the value for storage
		$storage->add($fid,$element->eid,$value);

	}// EOF foreach formelement LOOP

// ++++++++++++++++++++++++++++++++++
// ERROR STARTS HERE
// ++++++++++++++++++++++++++++++++++

//App Plugin on validate
$pluginManager->onValidate($values, $storage, $error);

if($error){
	
	//App Plugin on error
	$pluginManager->onError();
	
	//* ERROR - Reprint Form
	if($submit) $print->error($error);

	//		metaTitle($jobs->title);

	if(M4J_FORM_TITLE){
		$print->heading(MReady::_($jobs->title));
	}
	$print->headertext($jobs->maintext);

	// Check if there are required Elements for printing an advice
	if(isset($jobs->fid)){
		checkRequired($jobs->fid);
	}
	// Writing the form head tag
	$print->form_head(null,$jid,$jid,$jobs->cid);

	// Element ID Heap
	$eidHeap = array();
		
		$fid = intval($fids);

		$query = "SELECT *  FROM #__m4j_forms WHERE `fid` = '".$fid."'";
		$database->setQuery( $query );
		$form = $database->loadObjectList();

		$GLOBALS['M4J_USE_HELP'] = ($form[0]->use_help==1) ? 1 : 0 ;

		// Layout
		$layout = MLayoutList::get('layout01');
		$layout->addData(MLayoutList::makeData($form[0]->layout_data));
		$layout->setHelp($form[0]->use_help);
		$layout->reset();


		if($form){
			$query = "SELECT * FROM #__m4j_formelements WHERE `fid`='".$fid."' AND `active` = '1' ORDER BY `slot`,`sort_order` ASC";
			$database->setQuery( $query );
			$rows = $database->loadObjectList();

			foreach ($rows as $row){
				//Add eid to eid heap	
				array_push($eidHeap, $row->eid);
			
				$options = array();
				$option_count = sizeof(explode(';',$row->options))-1;
				if($option_count==-1) {
					$option_count=null ;
				}else {
					$options = explode(';',$row->options);
				}
					
				$html = $row->html;
				switch($row->form)
				{
					case 1:
						if($values[$row->eid] == M4J_LANG_YES) {
							$html= '  <input name=\'m4j-'.$row->eid.'\' type=\'checkbox\' id=\'m4j-'.$row->eid.'\' value= \'1\' checked="checked" ></input>';
						}
						if($values[$row->eid] == M4J_LANG_NO) {
							$html= '  <input name=\'m4j-'.$row->eid.'\' type=\'checkbox\' id=\'m4j-'.$row->eid.'\' value= \'1\' ></input>';
						}
						break;

					case 2:
						$html = $print->replace_yes_no($html);
						break;

					case ($row->form>=10 && $row->form<30):
						$html = str_replace('{'.$row->eid.'}', $values[$row->eid], $html);
						break;
							
					case ($row->form>=30 && $row->form<33):
						if($option_count){
							for($t=0;$t<$option_count;$t++){
								$html= str_replace('{'.$row->eid.'-'.$t.'}', $print->is_selected($values[$row->eid],$options[$t],$row->form), $html);
							}
						}
						break;

					case ($row->form>=33 && $row->form<40):
						if($option_count){
							$heap = $values[$row->eid];
							$heap_size = sizeof($heap);
							$i=0;
							for($t=0;$t<$option_count;$t++)
							{
								$replace ='';
								if($heap_size>0 && $i<$heap_size)
								{
									$replace = $print->is_selected($heap[$i],$options[$t],$row->form);
									if($replace !='') $i++;
								}
								$html= str_replace('{'.$row->eid.'-'.$t.'}', $replace, $html);
							}
						}
						break;
							

				}
				// ++++++++++++++++++++++++++
				// Append html to Layout Slot
				// ++++++++++++++++++++++++++
					
				if($row->form>=50 && $row->form<60){
					
				}else{
					$isHidden = ($row->form == 23) ? 1 : 0;
					$layout->addRow($row->slot,$row->question,stripslashes($html),$row->required,$row->help,$row->align,0,$row->eid, $isHidden);
				}
			}
				
			// Render Layout
			$layout->render(true);
				
		}// EOF Form exists
		else {
			$print->error_no_form();
		}

	//EID HEAP to JS
	$proformsJSFields="\t var pfmFields = [" .implode(",", $eidHeap)."];\n";
	$document->addScriptDeclaration($proformsJSFields);	
	
	
	//App Plugin at form footer
	echo $pluginManager->formFooter();
	
	
	//* CAPTCHA
	if(M4J_IS_CAPTCHA && ! $GLOBALS["proforms_is_human"]){
		purge_captcha();
		$captcha = random_string();
		$proceed = true;
		$user = null;
		while($proceed)
		{
			$user = random_string(32);
			$query = "SELECT COUNT(*) as hits  FROM #__m4j_captcha WHERE user= '".$user."'";
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			if($rows[0]->hits == 0) $proceed = false;
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
	}
	
	//EOF CAPTCHA
		
}else //* ++++ SENDING THE MAIL ++++ *//
{

	$pluginManager->onSuccess();
	
	
	purge_captcha();
	if($email=='' ) {
		$print-> mail_error();
	}else{
		// Email address is available
		
		$to = $email;
		if($jobs->subject != ""){
			$subject = $jobs->subject;
		}else {
			$subject = $jobs->title;
		}
		
		$bodyHead = $print->body_header($jobs->hidden);
		
		$body = $print->values_head();

		// FIDS LOOP
		
		$fid = intval($fids);

		$query = "SELECT * FROM #__m4j_formelements WHERE `fid` = '".$fid."'  AND `active` = '1' ORDER BY `slot`,`sort_order` ASC";
		$database->setQuery( $query );
		$elements = $database->loadObjectList();


		foreach ($elements as $element){
			if(!($element->form>=50 && $element->form<60)){
				$body .= $print->values($element->question, $print->format_value($values[$element->eid],$element->form));
			}
		}

		$userInfo = "";
		if(M4J_SHOW_USER_INFO) {
			$userInfo = $print->server_data();
		}
//		$body .= $print->values_footer();

		//create the tmpDir
		$tmpDir = 	md5(uniqid("",true));

			
		// Validate for data listing
		$confirmBody = $body;
		if(! $jobs->data_listing_confirmation) $confirmBody = "";
		if(! $jobs->data_listing) $body = '<table width="100%" border="0"><tbody>';
		
		
		// Create Email
		$fromMail = M4J_FROM_EMAIL;
		$fromName = M4J_FROM_NAME;
		$mailBody = $storage->replaceByAlias($bodyHead).$body.$userInfo.$print->values_footer();
		$mail = m4jCreateMail($fromMail,$fromName,$storage->replaceByAlias($subject),$mailBody);
		
		$mail->CharSet = M4J_MAIL_ISO;
		$mail->IsHTML(M4J_HTML_MAIL);
		// Check Multiple Mails for J1.6+ compatibility
		$multiples = preg_split("/[;,]+/", $to);
		if(is_array($multiples) && sizeof($multiples) > 1 ){
			foreach ($multiples as $mailAddress){
				$mail->AddAddress($mailAddress);					
			}
		}else {
			$mail->AddAddress($to);			
		}		
		
		// Moving the uploads to the directory
		$tmp_dir = M4J_TMP.$tmpDir;
		$remove_heap= NULL;

		if($upload_heap)
		{
			JFolder::create($tmp_dir);
			foreach ($upload_heap as $upload_element)
			{
				if(($name = $_FILES[$upload_element]['name']) != NULL)
				{

					$dest = $tmp_dir."/".$name;
					JFile::upload($_FILES[$upload_element]['tmp_name'],$dest);
					$remove_heap[] = $dest;
					$mail->AddAttachment($dest);
					// Don't add attachment to confirmation mail !
				}
			}//EOF foreach
		}//EOF upload_heap
		
		$dummy = new stdClass();
		// App Plugins actions before email sending
		$pluginManager->onBeforeEmail($mail, $dummy, $upload_heap);
		
		
				
		//Need to buffer after sending output because of app plugin system
		$afterSendingBuffer = null;
		
		//Sending the main email
		
			$sendingResult = 1;
			// Don't send email if Opt-In and email sending after confirmation is activated
			if(! $pluginManager->isStop("email")){
				$sendingResult = $mail->Send();
			}
			
			if($sendingResult){
				if($jobs->aftersending){
					if($jobs->aftersending == 1 ){
						//NORMAL REDIRECT
						if(! $pluginManager->isStop("redirection"))	{
							m4jDeleteTemporaryFiles($upload_heap, $dataStorage, $pluginManager, $remove_heap, $tmp_dir);
							m4jRedirect( $jobs->redirect );	
						}
					}else{
						$afterSendingBuffer = $storage->replaceByAlias($jobs->custom_text);
					}	
				}else{
					$afterSendingBuffer = $print->sent_success(1);
				}
				
				// App Plugin alter on after sending buffer.
				$pluginManager->onAfterSending($afterSendingBuffer);
				
				if(! $pluginManager->isStop("aftersending")){
					echo $afterSendingBuffer;
				}
			}else {
				$print->sent_error();
			}//EOF sending error
			
			//Check for intruders
			M4J_validate::secure();
	
		//Delet temporary files	
		m4jDeleteTemporaryFiles($upload_heap,  $pluginManager, $remove_heap, $tmp_dir);
		
	}//EOF else email is available

}//EOF sending the email

function m4jDeleteTemporaryFiles(& $upload_heap, & $pluginManager, & $remove_heap, $tmp_dir = null){
	if(!$tmp_dir || sizeof($remove_heap) == 0) return null;
	//Removing the temporary files if no data storage
	if(  $upload_heap &&  ! $pluginManager->isStop("deletetemp")  ){
		foreach ($remove_heap as $kill) {
			JPath::setPermissions($kill,777);
			JFile::delete($kill);
		}
		JPath::setPermissions($tmp_dir,777,777);
		JFolder::delete($tmp_dir);
	}//EOF removing temp files	
}





?>