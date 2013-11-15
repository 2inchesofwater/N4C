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

class MView extends JObject{
	
	var $app, $controller, $document;
	var $_BASE, $_TEMPLATES, $_INCLUDES, $_LANGUAGE,  $_HTTP, $_JS, $_CSS, $_IMAGES;
	var $jid,$cid;
	var $templateHeap = array();
	
	function __construct($app, & $controller){
		$this->app = $app;
		$this->controller = & $controller;
		$this->_BASE = $this->controller->_BASE;
		$this->_TEMPLATES = $this->_BASE."views" . DS . "tmpl" . DS;
		$this->_INCLUDES = $this->_BASE . "includes" .DS;
		$this->_LANGUAGE = $this->_BASE . "language" .DS;
		
		$this->_HTTP = M4J_HTTP_APPS . $this->app ."/" ;
		$this->_JS = $this->_HTTP . "js/";
		$this->_CSS = $this->_HTTP . "css/";
		$this->_IMAGES = $this->_HTTP . "images/";
		
		$this->jid = $this->controller->jid;
		$this->cid = $this->controller->cid;
		
		$this->document = & JFactory::getDocument();
		
	}
	
	function init(){
		return true;
	}
	
	function template($templateName = 'default' , $parameterArray = array() ){
		$parameterArray["_IMAGES"] = $this->_IMAGES;
		$parameterArray["_JS"] = $this->_JS;
		$parameterArray["_CSS"] = $this->_CSS;		
		return  MTemplater::get($this->_TEMPLATES. $templateName . ".php", $parameterArray);
	}
	
	function includeTemplate($templateName = 'default' , $parameterArray = array() ){
		$this->templateHeap[$templateName] = $this->template($templateName,$parameterArray);
	}
	
	function deleteTemplate($templateName = null){
		if(!$templateName){
			$this->templateHeap = array();
			return true;
		}
		
		if (isset($this->templateHeap[$templateName])){
			unset($this->templateHeap[$templateName]);
			return  true;
		}else return false;		
	}
	
	function renderTemplate(){
		echo implode("", $this->templateHeap);
	}
	
	function getParameters(){
		return $this->controller->params;
	}
	
	function getParam($name = null){
		if(!$name) return null;
		return $this->controller->params->$name;
	}
	
	function addModel($modelName = 'default'){
		$this->controller->addModel($modelName);
	}
	
	function & getModels(){
		return $this->controller->models;
	}
	
	function & getModel($modelName = 'default'){
		if(isset($this->controller->models[$modelName])){
			return $this->controller->models[$modelName];
		}else return  null;
	}
	
	function addLanguage(){
		$this->controller->addLanguage();
	}
	
	function addStyleSheet($sheetSource){
		$this->controller->addStyleSheet($sheetSource);
	}
	
	function styleSheets($sheets =array()){
		$this->controller->styleSheets($sheets);
	}
	
	function addScript($script = null){
		$this->controller->addScript($script);
	}
	
	function addScriptDeclaration($script = null){
		$this->controller->addScriptDeclaration($script);
	}
	
	function scripts($scripts = array() ){
		$this->controller->scripts($scripts);
	}
	
	function addFooterScript($script = null){
		$this->controller->addFooterScript($script);
	}
	
	function addFooterScriptDeclaration($script = null){
		$this->controller->addFooterScriptDeclaration($script);
	}
	
	function footerScripts($scripts = array() ){
		$this->controller->footerScripts($scripts);
	}	
	
	function httpImage($imageName = null){
		return $this->_IMAGES.$imageName;
	}
	
	function httpJS($jsName = null){
		return $this->_JS.$jsName;
	}
	
	function httpCSS($cssName = null){
		return $this->_CSS.$cssName;
	}
	
	function uri($params = null, $route = 0){
		return $this->controller->uri($params,$route);
	}
	
	function viewURI ($view = null, $route = 0){
		return $this->controller->viewURI($view,$route);
	}
	
}	
	

	

?>