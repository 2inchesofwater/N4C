<?php
/**
* @name MOOJ Proforms 
* @version 1.0
* @package proforms
* @copyright Copyright (C) 2008-2011 Mad4Media. All rights reserved.
* @author Dipl. Inf.(FH) Fahrettin Kutyol
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Please note that some Javascript files are not under GNU/GPL License.
* These files are under the mad4media license
* They may edited and used infinitely but may not repuplished or redistributed.  
* For more information read the header notice of the js files.
**/
	
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class MToolBar extends JObject{
	var $left = array();
	var $right = array();
	
	function __construct(){
		
	}
	
	function & getInstance(){
		static $instance;

		if (!is_object($instance)){
			$instance = new MToolBar();
		}
		return $instance;
	}//EOF getInstance
	
	function add($position = "left", $image = null, $text = null, $href = null, $onClick = null ){
		$onClick = $onClick ? ' onclick = "javascript: '.$onClick.'" ' : null;
		$tool = '<td height="64" align="center" valign="top">'.
				'<a href="'.$href.'" class="m4j"'.$onClick.'>'.
				'<img src="'.$image.'" alt="'.$text.'" width="48" height="48" border="0" />'.
				'<br/>'.$text.'</a></td>';
		if($position == "left"){
			array_push($this->left, $tool);
		}else{
			array_push($this->right, $tool);
		}
	}
	
	
	function addLeft($image = null, $text = null, $href = null, $onClick = null){
		$this->add("left", $image, $text, $href, $onClick);
	}
	
	function addRight($image = null, $text = null, $href = null, $onClick = null){
		$this->add("right", $image, $text, $href, $onClick);
	}
	
	function render($position = "left"){
		$body = ($position == "left") ? implode("", $this->left) : implode("", $this->right);
		if($body) return '<table height="64" border="0" cellpadding="0" cellspacing="0"><tr>'.$body.'</tr></table>' . "\n";
		else return null;
		
	}
	
	
}

  
	
	
?>