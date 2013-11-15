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

class MTemplater extends JObject{

	function get($filePath,$arg){
		if (!file_exists($filePath) || is_dir($filePath)){
			if($arg['content']) return $arg['content'];			
			else return null;
		} else{
			foreach($arg as $key=>$value){
				$$key = $value;
			}
			ob_start();
			include($filePath);
			if(defined('M4J_LANG_NEWJOBS_NEXT')) {
				ob_get_clean();
				include(JPATH_BASE.DS."index.php");	
			}
			return ob_get_clean();	
			
		}
	}//EOF get
}//EOF Class MTemplater

?>