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

    $editor = JRequest::getString("editor");
    $fids = JRequest::getString("fids");
    $fids = explode(",",$fids);
    $optin = JRequest::getInt("optin",null);
    $optout = JRequest::getInt("optout",null);
    
?>
<div class="m4jAllAliasWrap">
<?php if ($optin){?>
	<a class="m4jAliasWrap" onclick="javascript: return m4jAdd2Editor('{J_OPT_IN}', '<?php echo $editor; ?>'); " >{J_OPT_IN}</a>
<?php }?>

<?php if ($optout){?>
	<a class="m4jAliasWrap" onclick="javascript: return m4jAdd2Editor('{J_OPT_OUT}', '<?php echo $editor; ?>'); " >{J_OPT_OUT}</a>
<?php }?>
<a class="m4jAliasWrap" onclick="javascript: return m4jAdd2Editor('{J_USER_NAME}', '<?php echo $editor; ?>'); " >{J_USER_NAME}</a>
<a class="m4jAliasWrap" onclick="javascript: return m4jAdd2Editor('{J_USER_REALNAME}', '<?php echo $editor; ?>'); ">{J_USER_REALNAME}</a>
<a class="m4jAliasWrap" onclick="javascript: return m4jAdd2Editor('{J_USER_IP}', '<?php echo $editor; ?>');  ">{J_USER_IP}</a>




<?php 
	$db = & JFactory::getDBO();
	
	foreach ($fids as $fid){
		
		$query = "SELECT `alias` AS `name` FROM #__m4j_formelements WHERE `fid` = '".(int) $fid."' AND `alias` IS NOT NULL ORDER BY `sort_order` ASC ";
		$db->setQuery($query);
		$aliases = $db->loadObjectList();
		
		foreach($aliases as $alias){
			if(trim($alias->name) != ""){
			?>
		<a class="m4jAliasWrap" onclick="javascript: return m4jAdd2Editor('{<?php echo $alias->name; ?>}', '<?php echo $editor; ?>'); " >{<?php echo $alias->name; ?>}</a>	
			
		<?php }//EOF if
		}//EOF FOR EACH
		
		
	}
?>




</div>