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
	$fid = JRequest::getInt("fid",null);

	
	function §($string){
		echo $string."\n";
	}
	
	if(!$fid) die();
	$lang =& JFactory::getLanguage();
	$lang_code = substr($lang->getTag(),0,2);
	
	if(! file_exists(JPATH_ROOT . '/components/com_proforms/js/calendar/lang/calendar-'.$lang_code.'.js') || M4J_FORCE_CALENDAR) $lang_code = "en";
	
	
	§('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" >
		<head><meta http-equiv="content-type" content="text/html; charset=utf-8" />
	');
	
	$query = ' SELECT template '
				.' FROM #__templates_menu '
				.' WHERE client_id = 0 '
				.' AND menuid = 0 ';
		$database->setQuery($query);
		$defaultemplate = $database->loadResult();
	§('<base href="'.$m4jConfig_live_site.'/" />');
	§('<link rel="stylesheet" href="'.$m4jConfig_live_site.'/templates/'.$defaultemplate.'/css/template.css" type="text/css" />');
	
	§('  <link href="'.$m4jConfig_live_site.'/templates/'.$defaultemplate.'/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="'.M4J_FRONTEND.'js/balloontip/bubble-tooltip.css" type="text/css" media="screen"  />
  <link rel="stylesheet" href="'.M4J_FRONTEND.'css/stylesheet.css" type="text/css" />
  <link rel="stylesheet" href="'.M4J_FRONTEND.'js/calendar/calendar-system.css" type="text/css" media="all"  title="green" />
  <script type="text/javascript" src="'.M4J_FRONTEND.'js/joomla.javascript.js"></script>
  <script type="text/javascript" src="'.M4J_FRONTEND.'js/dojo.js"></script>
  <script type="text/javascript" src="'.M4J_FRONTEND.'js/underline.js"></script>
  <script type="text/javascript" src="'.M4J_FRONTEND.'js/balloontip/bubble-tooltip.js"></script>
  <script type="text/javascript" src="'.M4J_FRONTEND.'js/calendar/m4j.js"></script>
  <script type="text/javascript" src="'.M4J_FRONTEND.'js/calendar/calendar_stripped.js"></script>
  <script type="text/javascript" src="'.M4J_FRONTEND.'js/calendar/lang/calendar-'.$lang_code.'.js"></script>
	');
	
  §('<script type="text/javascript" > var m4jShowTooltip = 1; </script>"');	
	
	$query = "SELECT * FROM #__m4j_forms WHERE `fid` = '".$fid."' LIMIT 1";
		$database->setQuery( $query );
		$form = $database->loadObjectList();
		
	§('</head><body><center><table class="nopad"><tbody><tr valign="top"><td>
		<span style = "margin-left:32px; text-align:left; font-size:22px; font-weight: bold; display:block; height:46px; line-height: 170%; position: relative;" >'.
		M4J_LANG_PREVIEW.'</span> '.
		'<div style="width:100%;" id="proforms_proforms" class="m4j_form_wrap"><center>');
		
	$layout = MLayoutList::get('layout01');
	$layout->addData(MLayoutList::makeData($form[0]->layout_data));
	$layout->setHelp($form[0]->use_help);
	
	
	// DB Query Drawing the Table
		$query = "SELECT * FROM #__m4j_formelements WHERE `fid` = '".$fid."' AND `active` = '1' ORDER BY `slot`,`sort_order` ASC";
		$database->setQuery( $query );
		$formElements = $database->loadObjectList();
		
		
		foreach($formElements as $element){
			
			if($element->active){
				
				
			if($element->form== 2){
				$element->html = str_replace("{M4J_YES}", M4J_LANG_YES, $element->html);
				$element->html = str_replace("{M4J_NO}", M4J_LANG_NO, $element->html);
			}
			$hidden = ($element->form == 23) ? 1 : 0;
			$strip = "{".$element->eid."}";
			$html = str_replace($strip,"",$element->html);
			$layout->addRow($element->slot,$element->question,stripslashes($html),$element->required,$element->help,0,0,$element->eid ,$hidden);
					
			}
		}
		$layout->render(true); 
		§('</center></div></td></tr></tbod></table>
		<div style="visibility: visible; display: block; height: 20px; text-align: right; margin: 0pt; padding: 0pt; background-color: transparent;"><a href="http://www.mad4media.de" rel="follow" style="visibility: visible; display: inline; font-size: 10px; font-weight: normal; text-decoration: none; margin: inherit; padding: inherit; background-color: transparent;">mad4media </a><a href="http://www.mad4media.de/user-centered-design.html" rel="follow" style="visibility: visible; display: inline; font-size: 10px; font-weight: normal; text-decoration: none; margin: inherit; padding: inherit; background-color: transparent;">user interface design</a></div>
		</center>');
		§('</body></html>');
?>