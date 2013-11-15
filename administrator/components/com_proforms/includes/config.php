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
    include_once (M4J_INCLUDE_EDIT_AREA);
    $GLOBALS['editArea'] = new EditArea();
        
    define('M4J_NOBAR',0);	
    
	remember_cid();
	
	$tab = JRequest::getInt("tab",0);
	$isPatch = JRequest::getInt("patch",0);
	// Get task
	$reset =  m4jGetParam($_REQUEST, 'reset');
	$advice = intval(m4jGetParam($_REQUEST, 'advice'));
	
	// Config Variables
	$configVars = array(
		"email_root" => "string" , "mail_iso" => "string" , "from_name" => "string","from_email" => "string",
		"captcha" => "string","recaptcha" => "string", "class_heading" => "string","class_list_heading" => "string",
		"class_list_intro" => "string","class_list_wrap" => "string","class_header_text" => "string",
		"class_form_wrap" => "string", "class_form_table" => "string","class_error" => "string",
		"class_submit_wrap" => "string","class_submit" => "string","class_reset" => "string","class_required" => "string", "help_icon" => "int", "show_user_info" => "int",
		"captcha_duration" => "int","html_mail" => "int","show_legend" => "int","submission_time" => "int",
		"form_title" => "int","show_no_category" => "int","force_calendar" => "int","storage_td" => "int", "wa" => "int", 
		"force_admin_lang" => "string", "use_js_validation" => "int", "error_color" => "string"
    );
	
	// Process values
	foreach($configVars as $key => $type){
		switch($type){
			case 'int':
				$$key = JRequest::getInt($key);
				break;
				
			default:
			case 'string':
				$$key = JRequest::getString($key);
				break;
		}
	}
		
	// Action if reset
	if($reset){
		include_once (M4J_INCLUDE_RESET_CONFIGURATION);
		m4jRedirect(M4J_CONFIG.M4J_REMEMBER_CID_QUERY.'&advice=1');
	}  
		
	// Actions if update	
	if($task=='update'){
		$db = & JFactory::getDBO();
		//Write to db
			foreach($configVars as $key => $type){
			if($key =="wa"){
					$key = "workarea";
					$value = $db->getEscaped($wa); 
				}else{
					$value = $db->getEscaped($$key); 
			}
						
			$db->setQuery("UPDATE #__m4j_config SET ".
						  "`type` ='".$type."' , ".
						  "`value` = '".$value."' ".
						  "WHERE `key` = 'M4J_".strtoupper($key)."'");	
			$db->query();
		}
		
		m4jRedirect(M4J_CONFIG.M4J_REMEMBER_CID_QUERY.'&advice=2'."&tab=".$tab);
	}
	
	$feedback = $helpers->config_feedback($advice);
	
	$installerOutput = null;
	if($isPatch){
    	include_once (M4J_INCLUDE_INSTALL);
    	ob_start();
    	$installer = new MInstaller('patchfile');
    	$installerOutput = ob_get_clean();
    	if($installer->success) $feedback = '<span class="m4j_success">'.M4J_LANG_PATCHINSTALL_SUCCESS.'</span>';
	}
	
	
// Display config	  
HTML_m4j::head(M4J_CONFIG);
//    HTML_m4j::configuration(M4J_LANG_CONFIG,$helpers->config_feedback($advice));
 	$args = array("heading"=>M4J_LANG_CONFIG, "feedback"=>$feedback, "tab"=>$tab, "installerOutput" => $installerOutput);
 	echo MTemplater::get(M4J_TEMPLATES."config.php",$args);
HTML_m4j::footer();

?>
