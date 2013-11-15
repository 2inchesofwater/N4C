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
	remember_cid();
	
	$GLOBALS["_UNIQUE_ID"] = null;
	  
  HTML_m4j::head(M4J_SERVICE);
   
 $helpers->caption(M4J_LANG_SERVICE . " / " . M4J_LANG_HELPDESK); 
	// View	  
 	$args = array(
 	);
 	echo MTemplater::get(M4J_TEMPLATES."service.php",$args);
  HTML_m4j::footer();

?>
