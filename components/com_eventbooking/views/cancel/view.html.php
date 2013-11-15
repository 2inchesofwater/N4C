<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

jimport( 'joomla.application.component.view');
/**
 * HTML View class for the Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Booking
 * @since 1.0
 */
class EventBookingViewCancel extends JView
{
	function display($tpl = null)
	{		
	    $this->setLayout('default') ;
		$id = JRequest::getInt('id', 0) ;
		$config = EventBookingHelper::getConfig() ;
		$message = $config->cancel_message;
		if ($id > 0) {
			$db = & JFactory::getDBO() ;
			$sql = 'SELECT b.title FROM #__eb_registrants AS a INNER JOIN #__eb_events AS b '
				.' ON a.event_id = b.id '
				.' WHERE a.id = '.$id			
			;			
			$db->setQuery($sql) ;
			$title = $db->loadResult();
			$message = str_replace('[EVENT_TITLE]', $title, $message) ;
		}
		$this->assignRef('message', $message);				
		parent::display($tpl);				
	}
}