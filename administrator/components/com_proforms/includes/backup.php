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
define('M4J_NOBAR',0);	
    
$buildCompatibility = M4J_BACKUP_COMPAT;

remember_cid();
	
// Display config	  
HTML_m4j::head(M4J_BACKUP);
//    HTML_m4j::configuration(M4J_LANG_CONFIG,$helpers->config_feedback($advice));
 	$args = array("heading"=>M4J_LANG_BACKUP, "error"=>null , "sql"=>null, "message" => null);
 	echo MTemplater::get(M4J_TEMPLATES."backup.php",$args);
HTML_m4j::footer();

?>
