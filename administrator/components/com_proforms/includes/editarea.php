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

class EditArea extends JObject{
	var $areas = array();

	function __construct(){
		$document=& JFactory::getDocument();
		$document->addScript(M4J_EDIT_AREA.'edit_area_full_with_plugins.js');	
	}
	
	function add($id=null, $syntax=null){
		if(!$id || !$syntax) return null;
		$data = array();
		$data['id'] = $id;
		$data['syntax'] = $syntax;
		array_push($this->areas,$data);		
	}
	
	function append(){
		$document=& JFactory::getDocument();
			
		$lang =& JFactory::getLanguage();
//		echo'<pre>';
//		var_dump($lang);echo'</pre>';
		$langCode = explode("-",$lang->getTag());
		$langFile = M4J_PATH_JS.'editarea/langs/'.$langCode[0].".js";
		$language = "en";
		if(file_exists($langFile)) $language = $langCode[0];
		foreach($this->areas as $area){
			$url = M4J_EDIT_AREA.'init.php?id='.$area['id'].'&amp;syntax='.$area['syntax'].'&amp;lang='.$language ;
			$document->addScript($url);	
		}
	}
	
	
}



?>