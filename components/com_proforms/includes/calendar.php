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
	
	function init_calendar()
		{
			$lang =& JFactory::getLanguage();
			$lang_code = substr($lang->getTag(),0,2);
//			$lang_code = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
			
			$document=& JFactory::getDocument();
			$document->addStyleSheet(M4J_FRONTEND_CALENDAR.'calendar-system.css',"text/css","all",array("title"=>"green"));	
			$document->addScript(M4J_FRONTEND_CALENDAR.'m4j.js?basic=1');
			$document->addScript(M4J_FRONTEND_CALENDAR.'calendar_stripped.js?basic=1');
			
			if(M4J_FORCE_CALENDAR) $lang_code ="en";
			
			if(file_exists(M4J_JS_CALNEDAR.'lang/calendar-'.$lang_code.'.js?basic=1')){
				$document->addScript(M4J_FRONTEND_CALENDAR.'lang/calendar-'.$lang_code.'.js?basic=1');
			}else{
				$document->addScript(M4J_FRONTEND_CALENDAR.'lang/calendar-en.js?basic=1');
			}
		
		}//EOF init_calendar

	  
?>