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

class AppParameters extends JObject{
	
	var $self = null;
	var $parameters = null;
	var $selectors = "";
	var $isSend = 0;
	var $output = "";
	
	var $request = "string";
	var $requestParams = null;
	var $tableLeft = null, $tableRight = null;
	function __construct($self = null, $parameters = null) {
		if(!$self) return;
		
 		jimport('joomla.filesystem.file');
		jimport( 'joomla.utilities.simplexml' );
 		
		$this->self = $self;
		
		$this->requestParams = new stdClass();
		
		if($parameters && is_object($parameters)){
			$this->parameters = $parameters;
		}else{
			$this->parameters = new stdClass();
		}
		
		$this->isSend = (isset($_REQUEST["send"])) ? 1 : 0;
				
		$xmlName = (JFile::exists($self->base . "manifest.xml"))? "manifest.xml" : $self->name.".xml";
		
		$xml = new JSimpleXML();
		$isLoad = $xml->loadFile($self->base . $xmlName );
		if($isLoad){
			$doc =  & $xml->document;
			$kids = & $doc->children();
			foreach ($kids as $kid){
				switch($kid->name()){
					case "selectors":
						$this->_selectors($kid);
					break;
					
					case "params": 
						$this->tableLeft = $kid->attributes("left") ? ' style="width:'.$kid->attributes("left").';" ' :  '';
						$this->tableRight = $kid->attributes("right") ? ' style="width:'.$kid->attributes("right").';" ' :  '';
						$this->_params($kid);
					break;
					
				}//EOF switch			
			}//EOF foreach kids
		}//EOF isLoad
	}// EOF construct
	
	
	function _selectors(& $selectors){
		$sel = $selectors->children();
		$selArray = array();
		foreach($sel as $s){
			if($s->name() == "selector"){
				$namespace = $s->attributes("namespace");
				$heap = ( ! $s->attributes("heap") ) ? "static" : $s->attributes("heap");
				
				if($namespace){
					array_push($selArray, "\t" . '"'.$namespace.'": {heap: "'.$heap.'"}');
				}//EOF has both attributes
			}//EOF is selector
		}//EOF foreach
		
		$this->selectors = "\n\nvar ProformsSelectors = {\n" . implode(",\n", $selArray) . "\n}; \n";		
	}
	
	function _params(& $params){
		$prms = $params->children();
		foreach($prms as $p){

			 if($p->name() == "spacer"){
			 	
				$val = $p->attributes("value");
			 	$val = $val ? AText::_($val) : "<hr/>";
				
			 	$id = $p->attributes( "id");
			 	$id = $id ? ' id="'.$id.'" ' : '';
			 	
			 	$this->output .= '<tr'.$id.'><td colspan="2">'.$val.'</td></tr>'. "\n";
			 
			 }elseif ($p->name()== "intro"){
			 	$legend = $p->attributes("legend") ?  AText::_(trim($p->attributes("legend"))) : M4J_LANG_INFO;
			 	$id = $p->attributes( "id");
			 	$id = $id ? ' id="'.$id.'" ' : null;
			 	$this->_intro(AText::_(trim($p->data())), $legend , $id);
			 }
			 elseif ($p->name()== "param"){	
				
				
				$type = $p->attributes("type");
				$name = $p->attributes("name");
				$width = (int) $p->attributes("width");
				$height = (int) $p->attributes("height");
				$label = AText::_($p->attributes("label"));
				$info = AText::_($p->attributes("info"));
				$namespace = $p->attributes("namespace");
				$default = $p->attributes("default");
				$validate = $p->attributes("validate");
				$required = $p->attributes("required");
				$format = $p->attributes("format");
				$query = $p->attributes("query");
				$multiple = ( $p->attributes("multiple") == 1) ? 1 : 0 ;
				$allowed = $p->attributes("allowed");
				$usealias = $p->attributes("usealias");
				$src = $p->attributes("src");
				$this->request = $p->attributes("request");
				
				switch($type){
					case "text":
						$this->text($name, $label, $info, $default, $validate, $required, $width, $height );
						break;
					
					case "password":
						$this->password($name, $label, $info, $default, $validate, $required, $width, $height);
						break;
					
					case "textarea":
						$this->textarea($usealias, $name, $label, $info, $default, $validate, $required, $width, $height);
						break;
						
					case "editor":
						$this->editor($usealias, $name, $label, $info, $default, $validate, $required, $width, $height);
						break;
						
					case "code":
						$this->code($format, $name, $label, $info, $default, $required, $width, $height);
						break;
						
					case "switch":
						$this->_switch($name, $label, $info, $default, $validate, $required, $width, $height);
						break;
						
					case "calendar":
						$this->calendar($name, $label, $info, $default, $required = 0, $width, $height, $format );
						break;
						
					case "list":
						$this->_list($this->_getOptions($p), $name, $label, $info, $default, $required = 0, $width, $height, $format  );
						break;
					
					case "sql":
						$this->sql($query, $name, $label, $info, $default, $required = 0, $width, $height, $format  );
						break;
						
					case "selector":
						$this->selector($namespace,$multiple, $allowed, $name, $label, $info, $default, $validate, $required, $width, $height);
						break;	
							
					case "folder":
						$this->_folder($src, $name, $label, $info, $default, $required = 0, $width, $height, $format);
						break;
				}//EOF switch types
				
			 }//EOF
		}
	}
	
	function _intro($content = null, $legend = M4J_LANG_INFO, $id = null){
		$this->output .= '<tr'.$id.'><td colspan="2">'; 
		$this->output .= '<fieldset class="appIntroFieldset"><legend><img src="'.M4J_IMAGES.'info.png" align="top" style="margin-right: 5px;" /><span>'.$legend.'</span></legend><div>'.$content.'</div></fieldset>';
		$this->output .= '</td></tr>'. "\n";
	}
	
	
	function _getOptions(& $node){
		if(!$node) return array();
		$options = $node->children();
		$optionArray = array();
		foreach ($options as $option){
			if($option->name() == "option"){
				$value = $option->attributes("value");
				$text = AText::_($option->data());
				array_push($optionArray, array( "val" => $value, "text" => $text )) ;				
			}//EOF is option
		}//EOF foreach
		return $optionArray;
	}
	
	function _trID($name= null){
		return ' id="tr_'.$name.'" ';
	}
	
	function _getValue($attr=null, $default = null){
		if(!$attr) return null;
		if($this->isSend){
			$val = null;
			switch ($this->request){
				default:
				case "string": 
				 $val = JRequest::getString($attr,$default);
				break;
				
				case "int": 
				 $val = JRequest::getInt($attr,$default);
				break;
				
				case "float": 
				 $val = JRequest::getFloat($attr,$default);
				break;
				
				case "html": 
				 $val = JRequest::getString($attr,$default, 'default', JREQUEST_ALLOWHTML);
				break;
				
				case "raw": 
				 $val = JRequest::getString($attr,$default, 'default', JREQUEST_ALLOWRAW);
				break;
			}
			$this->requestParams->$attr = $val;
			return $val;
		}else{
			return ( isset( $this->parameters->$attr ) ) ? $this->parameters->$attr : $default;
		}
	}
	
	function _styleBounds($width = null, $height = null){
		$width = $width ? "width:".$width."px; " : "";
		$height = $height ? "height:".$height."px; " : "";
		return ' style="'.$width.$height.'" ';
	}
	
	function _getInfo($info = null){
		return $info ? '<img src="'.M4J_IMAGES.'info.png" align="top" style="margin-left: 5px;" info="'.$info.'" />' : "";
	}
	
	function text($name = null, $label = null, $info = null, $default = null, $validate = null, $required = 0, $width =null, $height = null  ){
		
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td'.$this->tableRight.'>
				<input name="'.$name.'" type="text"'.$this->_styleBounds($width,$height).' value="'.$this->_getValue($name,$default).'" required="'.(int) $required.'"></input>
			</td>
		</tr>' ."\n" ;
	}
	
	function password($name = null, $label = null, $info = null, $default = null, $validate = null, $required = 0, $width =null, $height = null  ){
		
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td'.$this->tableRight.'>
				<input name="'.$name.'" type="password"'.$this->_styleBounds($width,$height).' value="'.$this->_getValue($name,$default).'" required="'.(int) $required.'"></input>
			</td>
		</tr>' ."\n" ;
	}
	
	function textarea($usealias= null, $name = null, $label = null, $info = null, $default = null, $validate = null, $required = 0, $width =null, $height = null  ){
		
		$alias = "";
		if($usealias){
			$extended = ',1';
			switch ($usealias){
				case "extendednoopt": 
					$extended = ',2';
					break;
					
				case "extended": 
					$extended = ',3'; 
					break;
			}
			$alias = '<a id="ASN_'.$name.'" class="aliasSelector" style="" onclick="javascript: AliasBalloon.show(\''.$name.'\',this'.$extended.',0); return false;">'.M4J_LANG_INSERT_FIELD_VALUE.'</a><br/> ';
		}
		
		$this->output .= '<tr'.$this->_trID($name).'>
				<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
				<td'.$this->tableRight.'>
					'.$alias.'<div class="m4jCLR">
					<textarea name="'.$name.'" '.$this->_styleBounds($width,$height).' 
				      required="'.(int) $required.'"
				      id="ATA_'.$name.'" >'.$this->_getValue($name,$default).'</textarea>
				</td>
		</tr>' ."\n" ;
		
	}
	
	function editor($usealias= null, $name = null, $label = null, $info = null, $default = null, $validate = null, $required = 0, $width =null, $height = null  ){
		$alias = "";
		if($usealias){
			$extended = ',1';
			switch ($usealias){
				case "extendednoopt": 
					$extended = ',2';
					break;
					
				case "extended": 
					$extended = ',3'; 
					break;
			}
			$alias = '<a id="ASN_'.$name.'" class="aliasSelector" style="" onclick="javascript: AliasBalloon.show(\''.$name.'\',this'.$extended.',1); return false;">'.M4J_LANG_INSERT_FIELD_VALUE.'</a><br/> ';
		}
		
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td'.$this->tableRight.'>'.$alias.' <div class="m4jCLR"></div>
			  '.GetMEditorArea($name, $this->_getValue($name,$default), $name, $width, $height,null,null).'
			</td>
		</tr>' ."\n" ;
	}
	
	function code($format = null, $name = null, $label = null, $info = null, $default = null, $required = null, $width = null, $height = null){
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td>
			  '. MForm::editArea($name,$this->_getValue($name,$default), $format,$name,null, $this->_styleBounds($width,$height) ) .'
			</td>
		</tr>' ."\n" ;
	}
	
	
	function _switch($name = null, $label = null, $info = null, $default = null, $validate = null, $required = 0, $width =null, $height = null  ){
		
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td'.$this->tableRight.'>
			  '.MForm::specialCheckbox($name, (int) $this->_getValue($name,$default)).'
			</td>
		</tr>' ."\n" ;
		
	}
	
	
	function calendar($name = null, $label = null, $info = null, $default = null, $required = 0, $width =null, $height = null, $format = null  ){
		JHTML::_('behavior.calendar'); //load the calendar behavior
		$format	= $format ? $format : '%Y-%m-%d' ;
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td>
			  '.JHTML::_('calendar', $this->_getValue($name,$default), $name, $name, $format,array('required' => $required) ) .'
			</td>
		</tr>' ."\n" ;

	}
	
	function _list($options =null, $name = null, $label = null, $info = null, $default = null, $required = 0, $width =null, $height = null ){
			
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td'.$this->tableRight.'>
			  '.MForm::select(
						$name,
						$options,
						$this->_getValue($name,$default),
						MFORM_DROP_DOWN,
						null,
						$this->_styleBounds($width,$height)
						) .'
			</td>
		</tr>' ."\n" ;
	}
	
	function sql($query=null, $name = null, $label = null, $info = null, $default = null, $required = 0, $width =null, $height = null ){
		$options = array();
		if($query){
			$db = & JFactory::getDBO();
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			foreach($rows as $row){
				array_push($options, array("val" => $row->value, "text"=> $row->key));
			}
		}
		
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td'.$this->tableRight.'>
			  '.MForm::select(
						$name,
						$options,
						$this->_getValue($name,$default),
						MFORM_DROP_DOWN,
						null,
						$this->_styleBounds($width,$height)
						) .'
			</td>
		</tr>' ."\n" ;
	}
	
	function _folder($src =null, $name = null, $label = null, $info = null, $default = null, $required = 0, $width =null, $height = null ){
		jimport('joomla.filesystem.folder');
		$src = JPATH_ROOT . DS . str_replace(array('/','\\'), DS, $src);
		MDebug::pre($src);
		$options = array();
		if(JFolder::exists($src)){
			$files = JFolder::files($src);
			MDebug::pre($files);
			if($files){
				foreach ($files as $file){
					$info = array("val" => $file, "text"=> AText::_($file));
					array_push($options,$info);
				}
			}
		}
		
		
		$this->output .= '<tr'.$this->_trID($name).'>
			<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
			<td'.$this->tableRight.'>
			  '.MForm::select(
						$name,
						$options,
						$this->_getValue($name,$default),
						MFORM_DROP_DOWN,
						null,
						$this->_styleBounds($width,$height)
						) .'
			</td>
		</tr>' ."\n" ;
	}
	
	function selector($namespace= null, $multiple = 0, $allowed = null, $name = null, $label = null, $info = null, $default = null, $validate = null, $required = 0, $width =null, $height = null  ){
		$wrapWidth = $width ? 'style="width: '. ($width - 34) .'px;"' : "";
		$spanWidth = $width ? 'style="width: '. ($width - 64) .'px;"' : "";
		$isMultiple = $multiple ? ",1" : ",0";
		$allowedForms = $allowed ? ",'".$allowed."'" : ", null";
		$this->output .= '<tr'.$this->_trID($name).'>
				<td'.$this->tableLeft.'><label>'.$label.'</label>'.$this->_getInfo($info).'</td>
				<td'.$this->tableRight.'><input class="selectorinput" 
						   namespace="'.$namespace.'" 
						   id="sel_'.$name.'" 
						   name="'.$name.'" 
						   type="hidden"
						   allowed="'.$allowed.'" 
						   multiple="'.(int) $multiple.'"
						   required="'.(int) $required.'" 
						   value="'.$this->_getValue($name,$default).'"></input>
				<div class="selector"'.$this->_styleBounds($width,$height).' id="selector_'.$name.'">		
					<div id="selwrap_'.$name.'" class="selwrap"'.$wrapWidth.' spanwidth="'.($width - 64) .'px'.'"></div>
					<img id="add_'.$name.'" class="add" src="'.M4J_IMAGES.'window_edit.png"  onclick="javascript: FieldBalloon.show( \''.$name.'\',\''.$namespace.'\''.$isMultiple.$allowedForms.'); "/>
					<div class="m4jCLR"></div>
				</div>
				</td>
		</tr>' ."\n" ;
		
	}
	
	function createSelectors($selectorArray = null, $doRender = 0){
		if(is_array($selectorArray)){
			$selectors = array();
			foreach($selectorArray as $namespace=>$heap){
				array_push($selectors, "\t" . '"'.$namespace.'": {heap: "'.$heap.'"}' );
			}//EOF foreach
			$this->selectors = "\n\nvar ProformsSelectors = {\n" . implode(",\n", $selectors) . "\n}; \n";	
			
			if($doRender) $this->renderSelectors();			
		}//EOF is Selector Array
	}
	
	
	function renderSelectors(){
		$document=& JFactory::getDocument();
		$document->addScriptDeclaration($this->selectors);	
	}
	
	
	function render(){
		$this->renderSelectors();
		echo '<table cellpadding="2" cellspacing="2" border="0" width="100%"><tbody>' ."\n";
		echo $this->output;
		echo '<tbody></table>' ."\n";
	}
	
	function save(& $appdb){
		if($this->isSend){
			$appdb->requestStatus();
			$appdb->parameters = $this->requestParams;
			$appdb->save();
		}
	}
	
	
	
	
}


?>