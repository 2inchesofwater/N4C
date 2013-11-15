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

$GLOBALS["_JSTEXT"] = array();

class JSText{
	
	function add($array = null){
		if($array){
			$GLOBALS["_JSTEXT"] = array_merge($GLOBALS["_JSTEXT"],$array);
		}
	}
	
	function render($nativeJoomla=true){
		
		$js = "";
		if(!$nativeJoomla){
			$js .= '<script type="text/javascript">'."\n";
		}
		
		
		$js .= 'var mText = {'."\n";
		foreach($GLOBALS["_JSTEXT"] as $key=>$value){
			$js .= "\t".$key.': "'.$value.'",'."\n";
		}
		$js .= "#|#";
		$js = str_replace(",\n#|#","\n",$js);	
		$js = str_replace("#|#","",$js);	
		$js .= "};\n";
		
		if(!$nativeJoomla){
			$js .= '</script">'."\n";
			echo $js;
		}else{
			$doc =& JFactory::getDocument();
			$doc->addScriptDeclaration($js);	
		}	
	}
	
}
?>