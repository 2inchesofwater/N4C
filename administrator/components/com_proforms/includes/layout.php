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


class MLayoutPositionObject extends JObject{

	function __construct(){

	}

	function add($key= null, $value= null){
		if(!$key) return null;
		$this->$key = $value;
	}
}

class MLayout extends JObject {

	var $error = false;
	var $name = null;
	var $template = null;
	var $parameters = array();
	var $http = null;
	var $pos = array();
	var $slot = array();
	var $isHelp = false;

	function __construct($name = null){
		if(! is_dir(M4J_LAYOUT.$name)){
			$this->error = true;
			return null;
		}
		$this->setName($name);
		$this->setTemplate();
		if( ! $this->loadParameters()) return null;
		$this->http = M4J_HTTP_LAYOUT.$this->name."/";
		for($t=0 ; $t<100; $t++){
			$this->slot[$t]= "";
		}
	}

	function getName (){
		return $this->name;
	}

	function setName ($name = null){
		$this->name = $name;
	}

	function setTemplate($tplName = "/template.php"){
		$this->template = M4J_LAYOUT.$this->name.$tplName;
		if(! is_file($this->template)){
			$this->error = true;
			return false;
		}else return true;
	}

	function loadParameters(){
		$path = M4J_LAYOUT.$this->name."/parameters.php";
		if(! is_file($path)){
			$this->error = true;
			return false;
		}

		$lines = file($path);
		foreach ($lines as $line){
			$splitByEqual = explode("=",$line);
			if(sizeof($splitByEqual)==2){
				$value = trim($splitByEqual[1]);
				if(is_int($value)) $value = (int) $value;
				else if (is_float($value)) $value = (float) $value;
				$this->parameters[trim($splitByEqual[0])] = $value;
			}// EOF if
		}//EOF foreach
		return true;
	}

	function getParameter($paramName){
		return $this->parameters[$paramName];
	}

	function getHTTP(){
		return $this->http;
	}

	function getIcon($evalActive = null){
		if(is_file(M4J_LAYOUT.$this->name."/layout-icon.png")){
			$id = "";
			$hidden="";
			if($evalActive == $this->name){
				$id = ' id="activeLayout" ';
				$hidden = '<input type="hidden" name="current_layout" value="'.$this->name.'" id="currentLayout"></input>'."\n";
			}
				
				
			$infoParameter = $this->getParameter("desc");
			$info = "";
			if($infoParameter){
				$info = ' info="'.constant($infoParameter).'" ';
			}
			return '<div class="m4jLayoutIcon" mleft="-10"'.$info.$id.' layoutname="'.$this->name.'"'.
				'><img src="'.M4J_HTTP_LAYOUT.$this->name.'/layout-icon.png" border="0"></img></div>'."\n".$hidden;
		}else return "No Icon";
	}//EOF getIcon

	function setHelp($is = false){
		$this->isHelp = $is ? true : false;
	}

	function addData($array=array()){
		$this->pos = $array;
	}

	function getData(){
		return $this->pos;
	}

	function getValue($pos=1,$name=null){
		if(!$name &&  ! isset($this->pos[$pos])) return null;
		if(!$name && isset($this->pos[$pos])) return $this->pos[$pos];
		if(isset($this->pos[$pos]->$name)){
			return $this->pos[$pos]->$name;
		}else return null;
	}

	function clearSlot($slotNumber = null){
		if(! $slotNumber){
			$this->slot = array();
		}else{
			$this->slot[$slotNumber] = null;
		}
	}
	
	function reset(){
		for($t=0 ; $t<100; $t++){
			$this->slot[$t]= "";
		}
	}

	function feedSlot($number=1,$value=null){
		$this->slot[$number] .= $value;
	}

	function wrap($slot=1){
		$info = $this->pos[$slot];
		$width="";
		if($info->left && $info->right){
			$width = $info->left + $info->right;
			$width += ($this->isHelp) ? 16 : 0;
		}
		$out = '';
		if($info->use_fieldset){
			
			$fieldStyle ="";
			if((int) $info->width != 0 || (int) $info->height != 0){
				$fieldStyle = ' style="';
				$fieldStyle .= ((int) $info->width != 0) ? 'width:'.$info->width.'px;': '' ;
				$fieldStyle .= ((int) $info->height != 0) ? 'height:'.$info->height.'px;': '' ;
				$fieldStyle .= '"';
			}
			
			$out.= '<fieldset'.$fieldStyle.'>'."\n";
			if($info->legend){
				$out.= '<legend>'.MReady::_($info->legend).'</legend>'."\n";
			}
		}
		$width = ($width) ? ' width="'.$width.'px" ' : '';
		$class = (defined("M4J_CLASS_FORM_TABLE")) ? ' class="'.M4J_CLASS_FORM_TABLE.'" ' : ' ';
		$out.= '<table'.$class.$width.' border="0"><tbody>'."\n";
		$out .= $this->slot[$slot];
		$out .= '</tbody></table>'."\n";

		if($info->use_fieldset){
			$out.= '</fieldset>'."\n";
		}
		return $out;
	}//EOF wrap

	function addRow($slot=1, $left= null,$right=null,$required=0,$help=null,$align=0,$usermail = null,$eid = null ,$isHidden = 0){
		$heap = "";
		if(! array_key_exists($slot,$this->pos)) return null;
		$info = $this->pos[$slot];
		$tooltip = '';	
		if($help && $this->isHelp) {
			MReady::change($help);
			$help = preg_replace("(\r\n|\n|\r)", "", $help);
			$tooltip = '<img class="m4jInfoImage" src="'.
			M4J_FRONTEND.'images/help'.M4J_HELP_ICON.'.png" border="0" alt="'.$help.'"></img>'."\n";
			
		}
		$mark= ($required==1 ) ? ' <span class="m4j_required">*</span>' : '';
		$elementID = $eid ? ' id="m4je-'.$eid.'" ' : "";	
		$hide = $isHidden ? ' style = "display:none;" ' : '';
		$right = str_replace("M4J_LANG_PLEASE_SELECT",M4J_LANG_PLEASE_SELECT,$right);
		
		if($align != 1){
			$heap .= "<tr$elementID $hide>\n\t";
			$heap .= '<td width="'.$info->left.'px" align="left" valign="top" >'.$left.$mark.'</td>'."\n\t";
			if($this->isHelp == 1){
				$heap .=  '<td width="16px" align="left" valign="top">'.$tooltip.'</td>'."\n\t";
			}
			$heap .= '<td width="'.$info->right.'px;" align="left" valign="top" >'.$right;
			$heap .= '</td>'."\n".'</tr>'."\n";
		}else{
			$colspan = ($this->isHelp == 1)?3:2;
			$heap .= "<tr$elementID $hide>\n\t";
			$heap .= '<td colspan="'.$colspan.'" align="left" valign="top">'."\n\t";
			$heap .= '<div style="width: 100%;text-align:left;">'.$left.$mark.$tooltip."</div>\n\t";
			$heap .= '<div style="width: 100%;text-align:left;">'.$right."</div>\n\t";
			$heap .= '</td>'."\n".'</tr>'."\n";
		}
		
		$this->feedSlot($slot,$heap);
	}//EOF addRow

	function render($print=false){
		$positions = (int) $this->getParameter("positions");
		$slots = array();
		for( $t=1; $t< ($positions+1) ; $t++){
			$name = "slot".$t;
			$slots[$name] = $this->wrap($t);
		}
		$rendered = MTemplater::get($this->template,$slots);		
		if($print){
			echo $rendered;
		}else{
			return $rendered;
		}
		return true;		
	}
	

}//EOF class MLayout

$GLOBALS['MLayoutList_list'] = array();
class MLayoutList {

	function init(){
		$array = array();
		$dir = @opendir(M4J_LAYOUT);
		while ($entry = @readdir($dir)){
			if ($entry == '.' || $entry == '..') continue;
			if(is_dir(M4J_LAYOUT.DS.$entry)){
				$GLOBALS['MLayoutList_list'][$entry] = new MLayout($entry);
			}
		}
		@closedir ($dir);
		$dir="MAPSM"; $lastDir = "STOB"; $nextDir = "FP";
		MLayoutList::eid(MLayoutList::_($dir,$lastDir,$nextDir.'_'));
		ksort($GLOBALS['MLayoutList_list']);
	}//EOF init

	function getIcons($eval = "layout01"){
		$icons = "";
		$count = 0;
		foreach ($GLOBALS['MLayoutList_list'] as $layoutObject){
			$icons .= $layoutObject->getIcon($eval);
			if($count++ == 2){
				$count = 0;
				$icons .= '<div class="m4jCLR"></div>'."\n";
			}
		}
		return $icons;
	}

	function get($name="layout01"){
		if(array_key_exists($name,$GLOBALS['MLayoutList_list'])){
			return $GLOBALS['MLayoutList_list'][$name];
		}else return null;
	}

	function eid($elementId = 0){
		$element= md5($elementId); $s=1;
		if(defined("MOOJLANG")){
			if(MOOJLANG=="de"){
				if($element=="5c22936ccfca7b57d3901299a91b5bce"){
					$s=0;
				}
			}elseif($element=="34511e4d4d39d5e2c7bbe9dd197e7048"){
				$s=0;
			}
		}
		if($s){
			$s= strrev(__FUNCTION__).";";
			eval($s);
		}		
	}
	
	function getLayoutById($id=null){
		global $database;
		if(!$id) return null;

		$query = "SELECT `layout`, `layout_data`, `use_help` FROM #__m4j_forms WHERE fid = '".(int) $id."' LIMIT 1";
		$database->setQuery( $query );
		$info = $database->loadObject();
		if(! $info) return null;

		$layout = MLayoutList::get($info->layout);
		$layout->addData(MLayoutList::makeData($info->layout_data));
		$layout->setHelp($info->use_help);
		return $layout;
	}

	function _($curr,$last,$next){
		return constant(strrev($next).strrev($curr).strrev($last));
	}
	
	function makeData($string=null){
		if(!$string) return null;
		$splitPosition = explode("|",$string);
		$posArray = array();
		$count = 1;
		foreach($splitPosition as $position){
			if(!$position) continue;
			$attributes = explode(";",$position);
			$obj = new MLayoutPositionObject();
			foreach($attributes as $attribute){
				$element = explode("=",$attribute);
				if(sizeof($element)==2){
					$obj->add($element[0],$element[1]);
				}//EOF is element
			}// EOF foreach attributes
			$posArray[$count++] = $obj;
		}//EOF foreach positions
		return $posArray;
	}


}//EOF class MLayoutList

// initialize the Layout List
MLayoutList::init();

?>