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


class Storage{

	var $jid = null;
	var $fids = null;
	var $fid = array();
	var $tmpDir = null;
	var $userEmail = null;
	var $optInIdent = null;
	var $insertID = null;
	
	function Storage($jid=null,$fid){
		$this->jid = (int) $jid;				
		$this->fid[intval($fid)] = array();
	}

	function add($fid = null, $eid=null,$content=null,$alias = null){
		if(is_array($content)){
			$content = implode("\n",$content);
		}
		$this->fid[$fid][$eid] = $content;
	}
	
	function & get($fid = null, $eid=null){
		return $this->fid[$fid][$eid];
	}
	
	function set($fid = null, $eid=null, $content = null){
		$this->fid[$fid][$eid] = $content;
	}

	function addTempDir($tempDir=null){
		$this->tmpDir = $tempDir;
	}
	
	function replaceByAlias($string = null, $escape = 0){
		global $database;
		
	$user =& JFactory::getUser();
	$ip = $_SERVER['REMOTE_ADDR'];
		if(! preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/",$ip)){
			 	$ip = "UNKNOWN";
	 }
	$username = $user->username ? $user->username : "Guest";
	$userrealname = $user->name ? $user->name : "Guest"; 
	
	
	// Replacing placeholders
	
	$string = preg_replace('/{(\s*)J_USER_IP(\s*)}/' , $ip , $string);
	$string = preg_replace('/{(\s*)J_USER_NAME(\s*)}/' , $username , $string);
	$string = preg_replace('/{(\s*)J_USER_REALNAME(\s*)}/' , $userrealname , $string);
		
		foreach($this->fid as $element){			
			foreach($element AS $key => $value){
				$database->setQuery("SELECT `alias` FROM #__m4j_formelements WHERE `eid` = '".(int) $key."' LIMIT 1");
				$el = $database->loadObject();
				if($el){
					$value = $escape ? $database->getEscaped($value) : $value;
					$string = preg_replace('/{(\s*)'.trim($el->alias).'(\s*)}/' , $value , $string);
				}//EOF if
				else{
					$string .= "<br />EID: " . $key . "has no Alias";
				}
			}// foreach key value
		}//EOF foreach
		return $string;
	}

}


?>