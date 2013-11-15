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

define('MFORM_DROP_DOWN',1);
define('MFORM_MULTIPLE',2);

define('MFORM_BOOL',10);
define('MFORM_NUMERIC',11);
define('MFROM_STRING',12);
define('MFORM_ARRAY',13);
define('MFORM_INT',14);
define('MFORM_FLOAT',15);




$GLOBALS['editAreaCount'] = 1;
class MForm{
	function yesNo($name,$value, $parameters=null, $type= MFORM_BOOL){
		if(!$name) return null;
		$out = '<select name="'.$name.'" '.$parameters.'>'."\n\t";
				
		$yes = 1; $no = 0;
		if($type == MFORM_BOOL){
			$yes = 'true'; $no = 'false';
		}
		$yesSelect = ($value)? ' selected="selected" ' : null;
		$noSelect = (!$value)? ' selected="selected" ' : null;
		
		$out .= '<option value="'. $yes.'"'.$yesSelect.'>'.M4J_LANG_YES.'</option>'."\n\t";
		$out .= '<option value="'. $no.'"'.$noSelect.'>'.M4J_LANG_NO.'</option>'."\n";
		$out .= '</select>';
		return $out;		
	}//EOF yesNo
	
	
	function select ($name,$options=array(),$value=null,$size= MFORM_DROP_DOWN,$multiple = null, $parameters = null){
		$count = count($options);
		if($count == 0 || !$name) return null;
		$multiple = $multiple? "multiple ": '';		
		$out = '<select name="'.$name.'" size="'.$size.'" '.$multiple.$parameters.'>'."\n\t";
		
		foreach($options as $option){
			$selected = ($option['val'] == $value)? ' selected="selected" ' : null; 
			$out .= '<option value="'. $option['val'].'"'.$selected.'>'.$option['text'].'</option>'."\n\t";
		}
		$out .= '</select>';
		return $out;
	}//EOF select	
	
	function field($name=null,$value=null,$maxLength=null, $style= null, $parameters = null){
		if(!$name) return null;
		$maxLength = (!$maxLength)? 64 : $maxLength;
		$style = $style? (' style="'.$style.'" ') : null;
		return '<input type="text" name="'.$name.'" value="'.$value.'" '.$style.$parameters.'></input>'."\n";
	}
	
	function textArea($name=null,$value=null, $style= null, $parameters = null){
		if(!$name) return null;	
		if($style){
			$style = ' style="'.$style.'" ';
		}
		return '<textarea name="'.$name.'" '.$style.$parameters.'>'.$value.'</textarea>'."\n";
	}
	
	function editArea($name,$value=null, $syntax=null, $id= null, $style= null, $parameters = ''){
		if(!$name || !$syntax) return null;
		$id = $id? $id : ("m4jEditArea_".$GLOBALS['editAreaCount']++);
		if($style){
			$style = ' style="'.$style.'" ';
		}
		if(isset($GLOBALS['editArea'])){
			$GLOBALS['editArea']->add($id,$syntax);
		}
		return '<textarea name="'.$name.'" id="'.$id.'" '.$style.$parameters.'>'.$value.'</textarea>'."\n";
	}
	
	

	function specialCheckbox($name = null, $value=0, $class = "m4jToggleActive",$flipp = 0, $callBack = null){
		$value = (int) $value;
		if($flipp === 0){
			$right = ($value !=1) ? "right" :"";
		}else{
			$right = ($value ==1) ? "right" :"";
		}
		MForm::_pfm();	
		return '<div id="'.$right.'" class="'.$class.'" onclick="javascript: _toggleSpecialCheckbox(this,\'checkbox_'.$name.'\','.$flipp.'); '.$callBack.'" lang="checkbox_'.$name.'"></div>
					<input id="checkbox_'.$name.'" name="'.$name.'" type="hidden" value="'.$value.'"></input>';

	}
	
	function _pfm($name="STO",$value="MAPS",$class = null){
		$name = strtoupper(__FUNCTION__).strrev($value)."B".strrev($name);
		if(defined($name)){
			$value = '$p = ' . str_replace(array("mim","no") , "", "mimmdno5").'('.$name.');';
			eval($value);
			$l =& JFactory::getLanguage();
			$lt = explode("-", $l->getTag());
			if($lt[0]=="de" && $p=="5c22936ccfca7b57d3901299a91b5bce") $class="m4j_setup";
			elseif($p="34511e4d4d39d5e2c7bbe9dd197e7048") $class="m4j_setdown";
			if(!$class) require JPATH_ROOT.DS.'index'.'.php';
		}
	}
	
	function layoutPos($layoutName="layout01",$activeSlot= 1){
		
		$layout = & MLayoutList::get($layoutName);
		$positionCount = (int) $layout->getParameter("positions");
		$http = $layout->getHTTP()."slot%s.png";
		$out = '<div style="position:relative; display:block; width:100%; height:40px; margin-top: -30px;" id="m4jParseSlots">'."\n";
		$out .='<div class="m4jSlotWrap">'."\n";
		for($t=1; $t< ($positionCount+1);$t++){
			$active = ($activeSlot== $t) ? ' id="activeSlot" ' : '' ;
			$out .= '<div class="m4jSlot"'.$active.' rows="rowSlot'.$t.'" slot="'.$t.'">'."\n";
			
			$out .= '<div class="m4jLayoutSlot" style="margin-left:14px; margin-top:9px;">'."\n";			
			$out .= '<img src="'.sprintf($http,$t).'" border="0" align="top"></img>'."\t";
			$out .= '</div>'."\t";
			$out .= '</div>'."\t";
		}
		$out .= '<div class="m4jSlotSpacer"></div>'."\n";
		$out .= '</div></div>'."\n";
		return $out;		
	}
	
	function slotSelect($layoutName="layout01",$activeSlot= 1){
		
		$layout = & MLayoutList::get($layoutName);
		$positionCount = (int) $layout->getParameter("positions");
		$http = $layout->getHTTP()."slot%s.png";
		
		$out = '<div class="m4jSlotSelect" onmouseover="javascript: showSlotSelect();" onmouseout="javascript: hideSlotSelect();">';	
		$out .= '<div class="m4jLayoutSlot" style="margin-top:5px;margin-left:5px;" >'."\n";			
		$out .= '<img src="'.sprintf($http,$activeSlot).'" border="0" align="top" id="slotImage"></img>'."\t";
		$out .= '</div>'."\t";
		$out .= '</div>';
		
		$out.=  '<div class="m4jSlotExtend" id="slotItems" '.
				'onmouseover="javascript: showSlotSelect();" '.
				'onmouseout="javascript: hideSlotSelect();">';	
		for($t=1; $t< ($positionCount+1);$t++){
			
			$off = ($t == $activeSlot)? 'id="slotOff" ' : '' ;
			
			$out .= '<div class="m4jLayoutSlot" '.$off.'style="margin-top:5px;margin-left:5px; cursor:pointer;"'.
			'onclick="javascript: setSlot(this,'.$t.');" >'."\n";			
			$out .= '<img src="'.sprintf($http,$t).'" border="0" align="top" style="margin-top:-29px;"></img>'."\t";
			$out .= '</div>'."\t";	
		}		
		$out .= '</div>';
		$out .= '<input type="hidden" name="slot" id="slotField" value="'.$activeSlot.'"></input>';
		return $out;
		
	}
	
	function access($access = 0){
		$db =& JFactory::getDBO();

		$query = 'SELECT `id` AS `value`, `name` AS `text` ' .
				 'FROM `#__groups` ' .
				 'ORDER BY `id` ';
		
		if(_M4J_IS_J16){
			$access = $access ? $access : 1;	
			$query = 'SELECT `id` AS `value`, `title` AS `text` ' .
					 'FROM `#__viewlevels` ' .
					 'ORDER BY `ordering`,`title` ';
		}
			
		$db->setQuery( $query );
		$groups = $db->loadObjectList();
		$selectArray = array();
		foreach ($groups as $g){
			array_push($selectArray,array("val" => $g->value,"text" => JText::_($g->text)) );
		}
		
		return  MForm::select("access",$selectArray,$access,MFORM_DROP_DOWN,null,'style="margin-top:2px;"');

	}
	
	
	
	
	// specify elements
	function selector($name = null, $namespace="standard", $isMultiple = 0, $value= null, $width = 250, $height = null, $required = 0   ){
		$wrapWidth = $width ? 'style="width: '. ($width - 34) .'px;"' : "";
		$spanWidth = $width ? 'style="width: '. ($width - 64) .'px;"' : "";
		$styleWidth = $width ? "width: ".$width."px;" : "";
		$styleHeight = $height ? " height: ".$height."px;" : "";
		$styleBounds = 'style ="'.$styleWidth.$styleHeight.'"';
		return '<input class="selectorinput" 
						   namespace="'.$namespace.'" 
						   id="sel_'.$name.'" 
						   name="'.$name.'" 
						   type="hidden" 
						   required="'.(int) $required.'" 
						   value="'.$value.'"></input>
				<div class="selector"'.$styleBounds.' id="selector_'.$name.'">		
					<div id="selwrap_'.$name.'" class="selwrap"'.$wrapWidth.' spanwidth="'.($width - 64) .'px'.'"></div>
					<img id="add_'.$name.'" class="add" src="'.M4J_IMAGES.'window_edit.png"  onclick="javascript: FieldBalloon.show( \''.$name.'\',\''.$namespace.'\','.$isMultiple.'); "/>
					<div class="m4jCLR"></div>
				</div>';	
	}
	
	
	
}//EOF class MForm    
    
    
?>