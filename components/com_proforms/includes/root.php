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

$print->catHeading(M4J_LANG_FORM_CATEGORIES);
metaTitle(M4J_LANG_FORM_CATEGORIES);
$query = "SELECT COUNT(*) as count FROM #__m4j_jobs WHERE  cid = '-1' ";
$database->setQuery( $query );
$count = $database->loadObjectList();

if($count[0]->count>0 && M4J_SHOW_NO_CATEGORY)
$print->listing(M4J_LANG_NO_CATEGORY,M4J_LANG_NO_CATEGORY_LONG,(M4J_CID.'-1'));

$query = "SELECT `name`, `cid`, `access` ,`introtext` FROM #__m4j_category WHERE  `active` = '1' ORDER BY `sort_order`";
$database->setQuery( $query );
$rows = $database->loadObjectList();
foreach ($rows as $row)
{
	if(M4J_validate::access($row->access)){
		$print->listing(MReady::_($row->name),$row->introtext,(M4J_CID.$row->cid));
	}
}

$pluginManager = & AppPluginManager::getInstance();	
$pluginManager->root();

?>