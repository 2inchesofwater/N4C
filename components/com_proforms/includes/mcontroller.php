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
	
//APPS Processing

class MController extends JObject{
	
	var $app, $_BASE ,$_VIEWS, $_MODELS;
	var $_INCLUDES, $_LANGUAGE,  $_HTTP, $_JS, $_CSS, $_IMAGES;
	var $view, $parameters, $document;
	var $models = array();
	var $jid, $cid;
	var $defaultView = 'default';
	var $isLanguage = 0;
	var $isAdmin = 0;
	var $langPostFix = null;
	var $buffer = null;
	
	function __construct($app = null, $isAdmin = 0, $parameters = null){
		$this->app = $app;
		$this->isAdmin = $isAdmin;
		$this->setAdmin($isAdmin);
		$this->_LANGUAGE = $this->_BASE . "language" .DS;
		
		$this->_HTTP = M4J_HTTP_APPS . $this->app ."/" ;
		$this->_JS = $this->_HTTP . "js/";
		$this->_CSS = $this->_HTTP . "css/";
		$this->_IMAGES = $this->_HTTP . "images/";
		
		$this->cid = JRequest::getInt('cid',null);
		$this->jid = JRequest::getInt('jid',null);
		
		$this->langPostFix = $isAdmin ?  "admin" : null ;
		AText::setApp($this->app);
		$this->document = & JFactory::getDocument();
		
		
		$view = JRequest::getString("appview",$this->defaultView);
		$this->setView($view);
		
		$this->setParameters($parameters);
		
		ob_start();
		$this->init();
		$this->buffer = ob_get_clean();
	}
	
	function init(){
		return true;
	}
	
	function setView($view = 'default'){
		jimport('joomla.filesystem.file');
		if(JFile::exists($this->_VIEWS.$view .".php")){
			include_once ($this->_VIEWS.$view .".php");
			$className = "AppView" . ucfirst(strtolower($view));
			if(class_exists($className) && get_parent_class($className)== "MView" ){
				$this->view = new $className($this->app,$this);
				return true;
			}else{
				$this->view = null;
				return false;
			}
			
			
		}else{
			$this->view = null;
			return false;
		}
		
	}
	
	function initView(){
		if($this->view) {
			$args = func_get_args();
			call_user_func_array(array(&$this->view, 'init'), $args);
//			$this->view->init();
		}
	}
	
	function setAdmin($value = 0){
		if($value){
			$this->_BASE = M4J_APPS_BASE.$this->app . DS ."admin" .DS;
		}else{
			$this->_BASE = M4J_APPS_BASE.$this->app.DS;
		}
			$this->_VIEWS = $this->_BASE."views" . DS;
			$this->_MODELS = $this->_BASE."models" . DS;
			$this->_INCLUDES = $this->_BASE . "includes" .DS;
	}
	
	function setParameters($parameters = null){
		if($parameters && is_object($parameters)){
			$this->parameters = $parameters;
		}else{
			$db = & JFactory::getDBO();
			$query = $this->isAdmin ?
					 "SELECT `admin_params` AS `parameters` FROM `#__m4j_apps` WHERE `app` = '" . $db->getEscaped($this->app) . "' LIMIT 1"  :
					 "SELECT `params` AS `parameters` FROM `#__m4j_apps2jobs` WHERE `app` = '" . $db->getEscaped($this->app) . "' AND `jid` = '". (int) $this->jid . "' LIMIT 1"  ;
			$db->setQuery($query);
			$dbParam = $db->loadObject();
			$this->parameters = $dbParam ? unserialize($dbParam->parameters): new stdClass();
		}
	}
	
	
	function addModel($modelName = 'default'){
		jimport('joomla.filesystem.file');
		if(JFile::exists($this->_MODELS.$modelName .".php")){
			
			include_once ($this->_MODELS.$modelName .".php");
			$className = "AppModel" . ucfirst(strtolower($modelName));
			if(class_exists($className) && get_parent_class($className)== "MModel" ){
				$this->models[$modelName] = new $className($this->app,$this);
				return true;
			}else{
				return false;
			}
				
				
		}else{
			return false;
		}
	}
	
	function removeModel($modelName = null){
		if(!$modelName) return false;
		if(isset($this->models[$modelName])){
			unset($this->models[$modelName]);
			return true;
		}else{
			return false;
		}
	}
	
	function & getModel($modelName = 'default'){
		if(isset($this->models[$modelName])){
			return $this->models[$modelName];
		}else return null;
	}
	
	function addLanguage(){
		if(!$this->isLanguage){
			$this->isLanguage = 1;
			AText::add($this->app,$this->langPostFix);
		}
	}
	
	function addMainLanguage(){
		AText::add($this->app);
	}
	
	
	function addStyleSheet($sheetSource){
		if($sheetSource){
			$sheetSource = (endsWith($sheetSource, ".css")) ? $sheetSource : $sheetSource.".css";
			$this->document->addStyleSheet($this->_CSS.$sheetSource);
		}
	}
	
	function styleSheets($sheets =array()){
		foreach ($sheets as $sheet){
			$this->addStyleSheet($sheet);
		}
	}
		
	function addScript($script = null){
		if($script){
			$script = (endsWith($script, ".js")) ? $script : $script.".js";
			$this->document->addScript($this->_JS.$script);
		}
	}
	
	function addScriptDeclaration($script = null){
		if($script){
			$this->document->addScriptDeclaration($script);
		}
	}
	
	function scripts($scripts = array() ){
		foreach($scripts as $script){
			$this->addScript($script);
		}
	}
	
	function addFooterScript($script = null){
		if($script){
			$script = (endsWith($script, ".js")) ? $script : $script.".js";
			addScriptAtEnd($this->_JS.$script);
		}
	}
	
	function addFooterScriptDeclaration($script = null){
		if($script){
			addScriptDeclarationAtEnd($script);
		}
	}
	
	function footerScripts($scripts = array() ){
		foreach($scripts as $script){
			$this->addFooterScript($script);
		}
	}
	
	function renderFooterScripts(){
		renderEndScripts();
	}	

	function render(){
		echo $this->buffer;
		$this->renderFooterScripts();
	}
	
	function uri($params = null, $route = 0){
		
		$uri = "index.php?option=com_proforms";
		
		if($this->isAdmin){
			$uri.= "&section=adminapps&app=".$this->app.M4J_REMEMBER_CID_QUERY;
		}else{
//			$uri .= "&view=app";
			$uri .= "&app=".$this->app;
			$uri .= $this->jid ? "&jid=" . $this->jid : "";
			$uri .= $this->cid ? "&cid=" . $this->cid : "";
		}
		
		if(is_array($params)){
			foreach($params as $key=>$value){
				$uri .="&".strtolower(str_replace(" ", "", $key)) ."=" . urlencode($value);
			}
		}elseif($params && is_string($params)){
			$uri.= (substr($params, 0,1) != "&" ) ? "&" .  $params : $params;
		}
		
		return $route ? JRoute::_($uri) : $uri;
	}
	
	function viewURI ($view = null, $route = 0){
		$view = $view ? "appview=".$view : null;
		return $this->uri($view, $route);
	}
	
	
}	
	

	

?>