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

class AppDB extends JObject{
	
	var $app, $jid, $status, $parameters;
	var $isLoad = 0;
	function __construct($app = null ,$jid = null){
		
		if($app){
			$this->app = $app;
		}
		
		if($jid){
			$this->jid = $jid;
		}
		
		$this->parameters = new stdClass();
	}
	
	function setStatus($status = 0){
		$this->status = $status;
	}
	
	function getStatus(){
		return $this->status;
	}
	
	function setParam($paramName = null, $param = null ){
		if (! $paramName) return false;
		$this->parameters->$paramName = $param;
	}
	
	function getParam($paramName = null ){
		if (! $paramName) return null;
		return  (isset($this->parameters->$paramName)) ?  $this->parameters->$paramName : null;
	}

	function paramsIfLoad(){
		return $this->isLoad ? $this->parameters : null;
	}
	
	function encodeParameters($parameters){
		if(empty( $parameters) ) return null;
		foreach ($parameters as & $parameter){
			$parameter = base64_encode($parameter);
		}
		return $parameters;
	}
	
	function decodeParameters($parameters){
		if(empty( $parameters) ) return null;
		
		foreach ($parameters as & $parameter){
			$parameter = base64_decode($parameter);
		}
		return $parameters;
	}
	
	
	function load(){
		$result = MDB::get("#__m4j_apps2jobs",null,MDB_( array("jid" => $this->jid , "app" => $this->app) ), "LIMIT 1");
		
		if($result){
			$this->status = $result[0]->active;
			$this->jid = $result[0]->jid;
			$this->app = $result[0]->app;
			
			$this->parameters = $this->decodeParameters( unserialize($result[0]->params ) );
			$this->isLoad = 1;
		}else{
			$this->isLoad = 0;
		}
	}
	
	function save($parameters = null){
		if($parameters && is_object($parameters)) $this->parameters = $parameters;
		$serialized = serialize($this->encodeParameters( $this->parameters ) );
		
		$isUpdate =  MDB::get("#__m4j_apps2jobs","jid",MDB_( array("jid" => $this->jid , "app" => $this->app) ), "LIMIT 1");
		$values = array(
			"jid" => $this->jid,
			"app" => $this->app,
			"active" => $this->status,
			"params" => $serialized
		);
		
		$size = sizeof($isUpdate);
		if( $size !=  0 ){
			MDB::update( "#__m4j_apps2jobs", $values, MDB_( array("jid" => $this->jid , "app" => $this->app) ) );
		}else{
			MDB::insert("#__m4j_apps2jobs" ,$values);
		}	
	}
	
	// Load only for Admin Apps 
	function loadMain(){
		$result = MDB::get("#__m4j_apps",null,MDB_( array("app" => $this->app) ), "LIMIT 1");
		
		if($result){
			$this->status = $result[0]->active;
			$this->app = $result[0]->app;
			
			$this->parameters = $this->decodeParameters(unserialize($result[0]->admin_params));
			$this->isLoad = 1;
		}else{
			$this->isLoad = 0;
		}
	}
	
	// Save only for Admin Apps 
	function saveMain($parameters = null){
		if($parameters && is_object($parameters)) $this->parameters = $parameters;
		$serialized = serialize($this->encodeParameters( $this->parameters ) );
		$values = array(
			"admin_params" => $serialized
		);
		
		MDB::update( "#__m4j_apps", $values, MDB_( array("app" => $this->app) ) );
	}
	
	
	
	function requestStatus($default = 0){
		$status = JRequest::getInt("appactivestate", $default);
		$this->status = $status;
	}
	
	
}


?>