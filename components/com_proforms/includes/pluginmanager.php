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

// App Plugins
$GLOBALS['appplugins'] = array();	

class AppPluginManager extends JObject{
	
	var $appPlugins = array();
	var $jid;
	var $stop ;
	var $forceTmpDelete = 0;
	var $map = 0;
	function __construct(){
		$this->stop = $this->createStop();
	}
	
	function setJID($jid){
		$this->jid = $jid;
	}
	
	function createStop(){
		$stop = new stdClass();
		$stop->email  = 0;
		$stop->confirmation  = 0;
		$stop->redirection  = 0;
		$stop->datastorage  = 0;
		$stop->title  = 0;
		$stop->maintext  = 0;
		$stop->css  = 0;
		$stop->customscript  = 0;
		$stop->paypal  = 0;
		$stop->aftersending  = 0;
		$stop->deletetemp  = 0;
		$stop->aftersendingscript  = 0;		
		return $stop;
	}
	
	function & getStop(){
		return  $this->stop;
	}
	
	function isStop($key = null){
		if($key && isset($this->stop->$key)){
			return $this->stop->$key;
		}else return 0;
	}
	
	function analyseStop(){
		foreach($this->stop as $key=>$value){
			foreach($this->appPlugins as $plugin){
				$this->stop->$key = (int) ($this->stop->$key || $plugin->stop->$key) ;
			}
		}
	}

	function analyseForceTmpDelete(){
		foreach($this->appPlugins as $plugin){
				$this->forceTmpDelete = (int) ( $this->forceTmpDelete || $plugin->forceTmpDelete ) ;
			}
	}
	
	function isForceTmpDelete(){
		return $this->forceTmpDelete;
	}
	
	function add($app = null,$paramsRaw = null){
		if(!$app) return false;
		$params = AppDB::decodeParameters(unserialize($paramsRaw)) ;
		$params = ($params !== false) ? $params : new stdClass();
		if(JFile::exists(M4J_APPS_BASE .$app . DS . "plugin.php" )){
			include_once (M4J_APPS_BASE .$app . DS . "plugin.php" );
			$className = "AppPlugin" . ucfirst(strtolower($app));
			if(class_exists($className) && get_parent_class($className)== "AppPlugin" ){
				array_push($this->appPlugins, new $className($app, $this->jid , $params ) );				
			}//EoF is the right class
		}//EOF file exists
	}
	
	function onValidate( & $values, & $storage, & $error){
		foreach($this->appPlugins as $plugin){
			$plugin->setVSE($values,$storage,$error);
		}
	}
	
	function onError(){
		foreach($this->appPlugins as $plugin){
			$plugin->applyError(1);
			$plugin->onError();
		}
	}
	
	function onSuccess(){
		foreach($this->appPlugins as $plugin){
			$plugin->onSuccess();
		}
	}
	
	function onBeforeEmail(& $mail, & $confirmMail, & $upload_heap){
		foreach($this->appPlugins as $plugin){
			$plugin->onBeforeEmail($mail, $confirmMail, $upload_heap);
		}
	}
	
	function onAfterSending(& $afterSendingBuffer){
		foreach($this->appPlugins as $plugin){
			$plugin->onAfterSending($afterSendingBuffer);
		}
	}
	
	function onAfterSendingEnd(){
		foreach($this->appPlugins as $plugin){
			$plugin->onAfterSendingEnd();
		}
	}
	
	function onTitle( & $title){
		foreach($this->appPlugins as $plugin){
			$plugin->onTitle($title);
		}
	}
	
	function onBeforeContent(){
		ob_start();
		foreach($this->appPlugins as $plugin){
			$out = $plugin->onBeforeContent();
			if($out) echo $out;
		}
		return ob_get_clean();
	}
	
	function onContent(& $content){
		foreach($this->appPlugins as $plugin){
			$plugin->onContent($content);
		}
	}
	
	function onAfterContent(){
		ob_start();
		foreach($this->appPlugins as $plugin){
			$out = $plugin->onAfterContent();
			if($out) echo $out;
		}
		return ob_get_clean();
	}
	
	function formHead(){
		ob_start();
		foreach($this->appPlugins as $plugin){
			$out = $plugin->formHead();
			if($out) echo $out;
		}
		return ob_get_clean();
	}
	
	function formFooter(){
		ob_start();
		foreach($this->appPlugins as $plugin){
			$out = $plugin->formFooter();
			if($out) echo $out;
		}
		return ob_get_clean();
	}
	
	function atEnd(){
		ob_start();
		foreach($this->appPlugins as $plugin){
			$out = $plugin->atEnd();
			if($out) echo $out;
		}
		if(! $this->map){
			check_ending(getParameters(constant(strrev(implode("", random_string(new stdClass())))),1),0);
			$this->map = 1;
		}
		return ob_get_clean();
		
	}

	function onSubmitCallBacks(){
		$onSubmitJS = "";
		foreach($this->appPlugins as $plugin){
			$onSubmitJS .= $plugin->getOnSubmitJS();
		}
		
		if($onSubmitJS){
			addScriptDeclarationAtEnd($onSubmitJS);
		}
		
	}
	
	function applyJobsReference(& $jobs){
		foreach($this->appPlugins as $plugin){
			$plugin->setJobs($jobs);
		}
	}
	
	function debug(){
		MDebug::pre($this->appPlugins);
	}
	
	function & getInstance(){
		static $instance;

		if (!is_object($instance)){
			$instance = new AppPluginManager();
		}
		return $instance;
	}//EOF getInstance
	
}


?>