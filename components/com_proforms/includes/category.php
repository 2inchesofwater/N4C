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
	
// load the plugin manager dummy
require_once (M4J_INCLUDE_PLUGINMANAGERDUMMY);

// render stylesheet
$print->stylesheet();
	
$rows=null;

if($cid==-1)
	{
	 $print->catHeading(M4J_LANG_NO_CATEGORY);
	 metaTitle(M4J_LANG_NO_CATEGORY);	
	 $print->headertext(M4J_LANG_NO_CATEGORY_LONG);
	}
else
	{	
	$query = "SELECT `name`, `access` , `introtext` FROM #__m4j_category WHERE `cid` = '".$cid."'  AND `active` = '1'";
	$database->setQuery( $query );	
	$rows = $database->loadObjectList();
	}
	
if($rows !=null || $cid==-1)
	{
	  if($cid !=-1)
	  	{
	  	  if( ! M4J_validate::access($rows[0]->access) ){
	  	  	JError::raiseError( 403, JText::_("ALERTNOTAUTH") );	
	  	  }
	  		
		  metaTitle(MReady::_($rows[0]->name));
		  $print->catHeading(MReady::_($rows[0]->name));
		  $print->headertext($rows[0]->introtext);
		}
	
	  $query = "SELECT `jid`, `title`, `introtext`, `access` FROM #__m4j_jobs WHERE `cid`= '".$cid."' AND `active` = '1' ORDER BY `sort_order`";
	  $database->setQuery( $query );	
	  $rows = $database->loadObjectList();
	  foreach ($rows as $row)
		{
			if(M4J_validate::access($row->access)){	
				$print->listing(MReady::_($row->title),$row->introtext,(M4J_JID.$row->jid."&cid=".$cid));
			}
		}
		$pluginManager = & AppPluginManager::getInstance();	
		$pluginManager->category();
		
	}
else $print->error_no_category();
	
	
?>