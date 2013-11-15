<?PHP
	/**
	* @version $Id: proforms 10041 2008-03-18 21:48:13Z fahrettinkutyol $
	* @package joomla
	* @copyright Copyright (C) 2008 Mad4Media. All rights reserved.
	* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
	* Joomla! is free software. This version may have been modified pursuant
	* to the GNU General Public License, and as distributed it includes or
	* is derivative of works licensed under the GNU General Public License or
	* other free or open source software licenses.
	* See COPYRIGHT.php for copyright notices and details.
	* @copyright (C) mad4media , www.mad4media.de
	*/

	/**  ENGLISH VERSION. NEEDS TO BE TRANSLATED */

	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

	define('M4J_LANG_FORM_CATEGORIES','Form categories');
	define('M4J_LANG_ERROR_NO_CATEGORY','Requested form category doesn\'t exist or is unpublished');
	define('M4J_LANG_ERROR_NO_FORM','Requested form doesn\'t exist or is unpublished');
	define('M4J_LANG_YES','Yes');		
	define('M4J_LANG_NO','No');	
	
	define('M4J_LANG_NO_CATEGORY','Forms not belonging to a category.');
	define('M4J_LANG_NO_CATEGORY_LONG','Here you can find all forms which are not assigned to a category.');
	define('M4J_LANG_SUBMIT','send');
	define('M4J_LANG_MISSING','Missing field: ');
	define('M4J_LANG_ERROR_IN_FORM','Missing required information:');
	define('M4J_LANG_ERROR_NO_MAIL_ADRESS','There is no destination address for this form. Message couldn\'t be sent.');
	define('M4J_LANG_ERROR_CAPTCHA','Wrong security code!');
	define('M4J_LANG_MAIL_SUBJECT','Form message: ');
	define('M4J_LANG_CAPTCHA_ADVICE','Hover over the left image and enter the security code into the right textfield.');
	define('M4J_LANG_REQUIRED_DESC','Required information.');
	define('M4J_LANG_SENT_SUCCESS','Data successfully sent.');
	
	//New To Version 1.1.8
	define('M4J_LANG_TO_LARGE','<br/> &nbsp;- File is too large ! Maximum: ');
	define('M4J_LANG_WRONG_ENDING','<br/> &nbsp;- File extension mismatch !<br/> &nbsp;&nbsp; Allowed extensions: ');
	
	//New To Version 1.1.9
	define('M4J_LANG_SENT_ERROR','While sending the email, an error has occurred.<br/> Mail not sent!');
	
		
	//New To Proforms
	define('M4J_LANG_ERROR_USERMAIL','You need to enter a valid email address: ');
	define('M4J_LANG_RESET','reset');
	define('M4J_LANG_REQUIRED','Is required and may not be blank.');
	define('M4J_LANG_ERROR_PROMPT','Our apologies. Some of the entered data are not valid and can not be processed. The corresponding fields are marked.');
	define('M4J_LANG_ALPHABETICAL','Must be alphabetical.');
	define('M4J_LANG_NUMERIC','Must be numeric.');
	define('M4J_LANG_INTEGER','Must be an integer.');
	define('M4J_LANG_URL','Must be an URL.');
	define('M4J_LANG_EMAIL','Must be a valid email address.');
	define('M4J_LANG_ALPHANUMERIC','Must be alphanumerical.');
	define('M4J_LANG_PLEASE_SELECT','Please select');
	define('M4J_LANG_ASK2CONFIRM','Please send me a confirmation.');
	define('M4J_LANG_ASK2CONFIRM_DESC','If you activate this checkbox; you will obtain a confirmation email of the submitted data.');
	// New to Proforms 1.0.5
	define('M4J_LANG_ERROR_NO_TEMPLATE','This form hasn\'t been assigned to a form template!');
	
	// New to Proforms 1.1
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','You have confirmed your submission at %s.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','You have revoked the confirmation of your submission at %s.');
	define('M4J_LANG_','');
?>