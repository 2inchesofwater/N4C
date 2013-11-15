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

    
	require_once(M4J_INCLUDE_APPTEXT);
  
//	$innerHTML ='<option value="">'.M4J_LANG_NOAPPFORJID.'</option>\n';
	$innerHTML ='';
    $jid = JRequest::getInt("jid", null);
    $db = & JFactory::getDBO();
        
    
     $query = "SELECT `a`.`app`, `aj`.`active` FROM `#__m4j_apps` AS `a`
			LEFT JOIN 
			(SELECT `app`, `active` FROM `#__m4j_apps2jobs` WHERE `jid` = '$jid') AS `aj` ON `a`.`app` = `aj`.`app`
			WHERE `a`.`active` = '1' AND `aj`.`active` = '1' AND `a`.`has_view` = '1'
			ORDER BY `a`.`sort_order` ASC "; 
    
    
    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if($rows){
		$innerHTML = "";
    	foreach($rows as $row){
    		AText::add($row->app);
    		$innerHTML .= '<option value="'.$row->app.'">'.AText::_("name",$row->app).'</option>\n';
    	}
    }
    
?>

{ jid: <?php echo $jid?>,  inner: '<?php echo $innerHTML; ?>'}