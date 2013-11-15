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

class MModel extends JObject{
	
	var $app, $_BASE, $controller;
	var $db;
	var $jid, $cid;
	
	function __construct($app, & $controller){
		$this->app = $app;
		$this->controller = & $controller;
		$this->_BASE = $this->controller->_BASE;
		$this->db = & JFactory::getDBO();
		$this->jid = $this->controller->jid;
		$this->cid = $this->controller->cid;
	}
	
	function init(){
		return true;
	}
	
		
	function getParameters(){
		return $this->controller->parameters;
	}
	
	function getParam($name = null){
		if(!$name) return null;
		return $this->controller->parameters->$name;
	}
	
	function getFormData(){
		if(! $this->jid) return null;
		$this->db->setQuery("SELECT * FROM `#__m4j_jobs` WHERE `jid` = '$this->jid' ");
		return $this->db->loadObject();
	}
	
	function uri($params = null, $route = 0){
		return $this->controller->uri($params,$route);
	}
	
	function viewURI ($view = null, $route = 0){
		return $this->controller->viewURI($view,$route);
	}	
	
}	
	

	

?>