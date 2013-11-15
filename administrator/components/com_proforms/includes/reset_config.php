<?PHP
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
$reset = array(
	"M4J_EMAIL_ROOT" => "you@yourdomain.com",
	"M4J_MAIL_ISO" => "utf-8",
	"M4J_FROM_NAME" => "Your From Name",
	"M4J_FROM_EMAIL" => "from_mail@yourdomain.com",
	"M4J_CAPTCHA" => "RECAPTCHA",
	"M4J_RECAPTCHA" => "red",
	"M4J_HELP_ICON" => "3",
	"M4J_MAX_OPTIONS" => "19",
	"M4J_CAPTCHA_DURATION" => "5",
	"M4J_HTML_MAIL" => "1",
	"M4J_SHOW_LEGEND" => "1",
	"M4J_SUBMISSION_TIME" => "10000",
	"M4J_FORM_TITLE" => "1",
	"M4J_SHOW_NO_CATEGORY" => "1",
	"M4J_FORCE_CALENDAR" => "0",
	"M4J_STORAGE_TD" => "250",
	"M4J_WORKAREA" => "940",
	"M4J_CLASS_HEADING" => "contentheading",
	"M4J_CLASS_LIST_HEADING" => "m4j_list_heading",
	"M4J_CLASS_LIST_INTRO" => "m4j_list_intro",
	"M4J_CLASS_LIST_WRAP" => "m4j_list_wrap",
	"M4J_CLASS_HEADER_TEXT" => "m4j_header_text",
	"M4J_CLASS_FORM_WRAP" => "m4j_form_wrap",
	"M4J_CLASS_FORM_TABLE" => "m4j_form_table",
	"M4J_CLASS_ERROR" => "m4j_error",
	"M4J_CLASS_SUBMIT_WRAP" => "m4j_submit_wrap",
	"M4J_CLASS_SUBMIT" => "m4j_submit",
	"M4J_CLASS_RESET" => "m4j_reset",
	"M4J_CLASS_REQUIRED" => "m4j_required",
	"M4J_SHOW_USER_INFO" => "1",
	"M4J_FORCE_ADMIN_LANG" => "",
	"M4J_USE_JS_VALIDATION" => "1",
	"M4J_ERROR_COLOR" => "ff0000"
	);
	
	foreach($reset as $key => $value){
		$field = array("value"=>$value);
		MDB::update("#__m4j_config",$field,MDB::_("key",$key));
	}
	
	
?>
