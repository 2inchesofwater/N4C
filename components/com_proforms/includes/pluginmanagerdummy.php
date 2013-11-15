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


class AppPluginManager extends JObject{

	var $stop = null;
	var $map = 0;
	function __construct(){
		$this->stop = new stdClass();
	}
	
	function & getStop(){
		return  $this->stop;
	}
	
	function isStop(){
		return 0;
	}
	
	function onBeforeContent(){
		return null;
	}
	
	function onContent(){
		return null;
	
	}
	
	function onAfterContent(){	
		return null;
	}
	
	function category(){
		$this->root();
	}
	
	function root(){
		if(! $this->map){
			M4J_validate::secure();
			$this->map = 1;
		}
		return null;
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