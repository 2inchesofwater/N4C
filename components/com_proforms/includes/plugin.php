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
	

class AppPlugin extends JObject{
	
	var $app = null;
	var $_BASE, $_INCLUDES, $_LANGUAGE,  $_HTTP, $_JS, $_CSS, $_IMAGES	  ;
	var $params = null;	
	var $document, $db;
	var $jid;
	var $stop ;
	var $redirectURL = null ;
	var $jsOnSubmit = "";
	var $isError = 0;
	var $forceTmpDelete = 0;
	var $jobs, $values, $storage, $error;
	
	function __construct($app = null, $jid = null, $params = null){
		if($app) $this->app = $app;
		if($jid) $this->jid = $jid;
		$this->params = $params ? $params : new stdClass();
		
		$this->document = & JFactory::getDocument();
		$this->db = & JFactory::getDBO();
			
		$this->_BASE = M4J_APPS_BASE .  $this->app .DS ;
		$this->_INCLUDES = $this->_BASE . "includes" .DS;
		$this->_LANGUAGE = $this->_BASE . "language" .DS;
		
		$this->_HTTP = M4J_HTTP_APPS . $this->app ."/" ;
		$this->_JS = $this->_HTTP . "js/";
		$this->_CSS = $this->_HTTP . "css/";
		$this->_IMAGES = $this->_HTTP . "images/";
		
		$this->stop = AppPluginManager::createStop();
		
		$this->init();
	}	

	function init(){
		return true;
	}

	function setVSE( & $values, & $storage, & $error){
		$this->values = & $values;
		$this->storage = & $storage;
		$this->error = & $error;
		
		$this->onValidate();
	}
	
	function onValidate(){
		return false;
	}
	
	function applyError($state = 0){
		$this->isError = $state;
	}
	
	
	function onError(){
		return false;
	}
	
	function onSuccess(){
		return false;
	}
	
	function onBeforeEmail(& $mail, & $confirmMail, & $upload_heap){
		return false;		
	}
	
	function onAfterSending(& $afterSendingBuffer){
		return false;
	}
	
	function onAfterSendingEnd(){
		return false;
	}
		
	/**
	 * Called on building the title of a form
	 * Doesn't require to return anything.
	 * @param	string	$title	The refernce of the title variable
	 */
	function onTitle( & $title){
		return false;
	}
	
	/**
	 * Called after the title of a form and before rendering the content (main text)
	 * Outputs can be echoed or returned 
	 */
	function onBeforeContent(){
		return false;
	}
	
	/**
	 * Called on rendering the content (main text) of a form
	 * Doesn't require to return anything.
	 * This method can be used to modify the main text of a form
	 * @param	string	$content	The refernce of the content variable
	 */
	function onContent(& $content){
		return false;
	}
	
	/**
	 * Called after rendering the content (main text) of a form
	 * Outputs can be echoed or returned 
	 */
	function onAfterContent(){
		return false;
	}
	
	/**
	 * Called inside the form tag at first
	 * Outputs can be echoed or returned 
	 */
	function formHead(){
		return false;
	}
	
	/**
	 * Called inside the form tag at the end.
	 * But it is called before the confirmation question and before the captcha and submit button
	 * Outputs can be echoed or returned 
	 */
	function formFooter(){
		return false;
	}
	
	/**
	 * Called at the end of the form site
	 * Outputs can be echoed or returned 
	 */
	function atEnd(){
		return false;
	}
	
	/**
	 * Adds an error message to the error buffer at the form validation
	 * As long as the error buffer is empty a form will be submitted
	 * If there is at least one character in the buffer no form will be submitted.
	 *
	 * @param	string	$errorText	The error message which shall be added.
	 */
	function addError($errorText = null){
		$this->error .= HTML_mad4jobs::add_error($errorText);
	}
	
	
	function disable($stopKey = null){
		$stopKey = strtolower(trim($stopKey));
		if(isset($this->stop->$stopKey)){
			$this->stop->$stopKey = 1;
		}
	}
	
	function enable($stopKey = null){
		$stopKey = strtolower(trim($stopKey));
		if(isset($this->stop->$stopKey)){
			$this->stop->$stopKey = 0;
		}
	}
	
	function addOnSubmitJS($jsFunctionName= null){
		if($jsFunctionName) $this->jsOnSubmit .= 'addValidationFunction("'.trim($jsFunctionName).'"); '."\n";
	}
	
	function getOnSubmitJS(){
		return $this->jsOnSubmit;
	}
	
	function setRedirect($url = null){
		$this->redirectURL = JRoute::_($url);
	}
	
	function redirect(){
		if($this->redirectURL){
			m4jRedirect($this->redirectURL);
		}
	}
	
	function setJobs( & $jobs){
		$this->jobs = & $jobs;
	}
	
	function footerScript($src = null){
		if($src) {
			addScriptAtEnd($src);
		}
	}
	
	function footerScriptDeclaration($code = null){
		if($code) {
			addScriptDeclarationAtEnd($code);
		}
	}
	
	function setForceTmpDelete($status = 1){
		$this->forceTmpDelete = $status;
	}
	
}
?>