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
 
define('MSEF_CAT',1);
define('MSEF_FORM',2);

class MSEF extends JObject{
	
	var $formId = null;
	var $catId = null;
	var $title = null;
	var $alias = null;
	var $sefUrl = null;

	function __construct($title=null,$alias=null,$formId=null,$catId=null){
		$this->title = $title;
		$this->alias = $alias;
		$this->formId =$formId;
		$this->catId = $catId;
		$this->createSEF();
	}
	
	function createSEF(){
		if(! $this->formId && ! $this->catId ) return null;	
		$url = ($this->alias)? $this->alias: $this->title;
		if(!$this->formId || $this->catId <0){
			$this->sefUrl = $this->check($this->get($url));
		}else{
			$db = & JFactory::getDBO();
			$query = $db->setQuery("SELECT `url` FROM #__m4j_sef WHERE `jid` = '0' AND `cid`= '".$this->catId."'");
			$cat = $db->loadObjectList();
			$this->sefUrl = $cat[0]->url."/".$this->check($this->get($url));
		}	
	}
	
	function insert(){
		$db = & JFactory::getDBO();
		$query = "INSERT INTO #__m4j_sef"
						. "\n ( `jid`, `cid`, `url` )"
						. "\n VALUES"
						. "\n ( '".(int) $this->formId."', '".$this->catId. "', '".$this->sefUrl."' )";
		$db->setQuery($query);
		$db->query();
	}
	
	function update(){
		$db = & JFactory::getDBO();
		if($this->formId){
			$query = $db->setQuery("SELECT * FROM #__m4j_sef WHERE `jid`= '".$this->formId."'");
			if(! $db->loadObject($query)){
				$this->insert();
			}else{
				$query = "UPDATE #__m4j_sef "
						. "\n SET"
						. "\n `cid` = '".$this->catId."', "
						. "\n `url` = '".$this->sefUrl."' "
						. "\n WHERE jid = '". $this->formId."' ";
				$db->setQuery($query);
				$db->query();
			}
		}else if(!$this->formId && $this->catId){
			$query = $db->setQuery("SELECT * FROM #__m4j_sef WHERE `jid` = '0' AND `cid`= '".(int)$this->catId."'");
			if(! $db->loadObject($query)){
				$this->insert();
			}else{
				$query = "UPDATE #__m4j_sef "
						. "\n SET"
						. "\n `jid` = '0', "
						. "\n `url` = '".$this->sefUrl."' "
						. "\n WHERE `jid` = '0' AND cid = '". $this->catId."' ";
				$db->setQuery($query);
				$db->query();
			}	
		}
	}
	
	function replace($string=null){
		$toReplace = " Š|S, Œ|O, Ž|Z, š|s, œ|oe, ž|z, Ÿ|Y, ¥|Y, µ|u, À|A, Á|A, Â|A, Ã|A, Ä|Ae, Å|A,".
					  " Æ|A, Ç|C, È|E, É|E, Ê|E, Ë|E, Ì|I, Í|I, Î|I, Ï|I, Ð|D, Ñ|N, Ò|O, Ó|O, Ô|O,".
					  " Õ|O, Ö|Oe, Ø|O, Ù|U, Ú|U, Û|U, Ü|Ue, Ý|Y, ß|ss, à|a, á|a, â|a, ã|a, ä|ae, å|a,".
					  " æ|a, ç|c, è|e, é|e, ê|e, ë|e, ì|i, í|i, î|i, ï|i, ð|o, ñ|n, ò|o, ó|o, ô|o,".
					  " õ|o, ö|oe, ø|o, ù|u, ú|u, û|u, ü|ue, ý|y, ÿ|y, ă|a, ş|s, ţ|t, ț|t, Ț|T, Ș|S, ș|s, Ş|S".
					  " @|at, #|-, $|s, §|s, *|-, '|-, \"|-, +|-, &|-, %|-, ~|-, :|-, ;|-";

		$string = str_replace(array("?","!","^","°","|","<",">","(",")","[","]","{","}","\\","`","´",","),"",$string);
		
		$firstSplit = explode(",",$toReplace);
		
		foreach ($firstSplit as $combination){
			$secondSplit = explode ("|",$combination);
			if(sizeof($secondSplit)== 2){
				$replace = trim($secondSplit[0]);
				$with = trim($secondSplit[1]);				
				$string = str_replace($replace,$with,$string);
			}
		}
		
		$string = str_replace(array("-----","----","---","--"," "),"-",$string);
		$string = str_replace(array("-----","----","---","--"," "),"-",$string);
		$string = str_replace(array("-----","----","---","--"," "),"-",$string);
		
		return $string;		
	}
	
	function get($string=null){
		if(!$string) return null;
		$string =  $this->replace($string);
		return strtolower($string);
	}
	
	function check($url=null){
		if(! $url) return null;
		$db = & JFactory::getDBO();
		$count = 2;
		$returnUrl = $url;
		$query = $db->setQuery("SELECT `url` FROM #__m4j_sef WHERE `url`= '".$url."'");
		while($db->loadResult($query)){
			$returnUrl = $url."-".$count++;
			$query = $db->setQuery("SELECT `url` FROM #__m4j_sef WHERE `url`= '".$returnUrl."'");
		}
		return $returnUrl;		
	}
	
	function delete($id=null,$type= null){
		if(!$type || !$id) return null;
		$db = & JFactory::getDBO();
		switch ($type){
			case MSEF_CAT:
				$query = "DELETE FROM #__m4j_sef WHERE `jid` = '0' AND `cid` = '".$id."'";	
				break;

			case MSEF_FORM:
				$query = "DELETE FROM #__m4j_sef WHERE `jid` = '".$id."'";
				break;
			
		}
		$db->setQuery($query);
		$db->query(); 	
	}
	
	
}
    
?>