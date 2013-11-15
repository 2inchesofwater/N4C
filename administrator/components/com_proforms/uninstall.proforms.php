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

defined('_JEXEC') or die('Direct Access to this location is not allowed.');


function com_uninstall()
{
	// Delete all app db tables
	$db = & JFactory::getDBO();
	$jConfig = new JConfig();
	$prefix = $jConfig->dbprefix;
	$prefixLength = strlen($prefix);
	$m4jPrefix = $prefix."m4j_";
	$db->setQuery("SHOW TABLES");
	$tableList = $db->loadRowList();
	foreach($tableList as $table){
		if(strpos($table[0], $prefix."m4j_") !== false){
			$proformsTable =  substr_replace($table[0], "#__", 0, $prefixLength);
			$db->setQuery("DELETE FROM `$proformsTable`;");
			$db->query();
			$db->setQuery("DROP TABLE `$proformsTable`;");
			$db->query();
		}
	}
	
	
	echo '<h1>You have successfully uninstalled Mooj Proforms BASIC</h1><br/>';
	
}




?>
