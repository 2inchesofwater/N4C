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

class ElementHelper extends JObject {
	
	var $items = array();
	var $unique = null;
	var $withAlias = array();
	function __construct($jid=null,$onlyActive=true, $onlyRealFields = true){
		if($jid){
			$job = MDB::get("#__m4j_jobs","fid",MDB_("jid",$jid));
			$fids = explode(";",$job[0]->fid);
			
			$realQuery = $onlyRealFields ? "AND NOT ( `form` = 50 ) " : "";
			$activeQuery = $onlyActive ? " AND `active` ='1' " : "";
			
			
			foreach ($fids as $fid){
				$db = & JFactory::getDBO();
				$query = "SELECT * FROM #__m4j_formelements WHERE `fid` ='".$fid."'".$realQuery.$activeQuery." ORDER BY `slot`,`sort_order` ASC";
				$db->setQuery($query);
				$elements =  $db->loadObjectList();
				
				foreach($elements as $element){
					if($element->alias) $this->withAlias[$element->eid] = $element->alias;
				}
				
				$query = "SELECT * FROM #__m4j_formelements WHERE `fid` ='".$fid."' AND `usermail` = '1' LIMIT 1";
				$db->setQuery($query);
				$unique =  $db->loadObject();
				
				$this->items =  array_merge($this->items,$elements);
				if($unique){
					$this->unique = $unique;
				}
			}
		}
	}
	
	function getElements(){
		return $this->items;
	}
	
	function getUnique(){
		return $this->unique;
	}
	
	function getUniqueEID(){
		if(!$this->unique) return null;
		else return $this->unique->eid;
	}
	
	function replaceByAlias($itemObjects = null, & $string, & $subject){
		if(!$itemObjects || ! is_array($itemObjects) ) return $string;
		$values = array();
		foreach($itemObjects as $item){
			$values[$item->eid] = $item->content;
		}
		
		foreach($this->withAlias as $eid => $alias){
			$value = isset($values[$eid]) ? $values[$eid] : "";
			$string = preg_replace('/{(\s*)'.trim($alias).'(\s*)}/' , $value , $string); 
			$subject = preg_replace('/{(\s*)'.trim($alias).'(\s*)}/' , $value , $subject); 
		}
		
			
	}
	
	
}


?>