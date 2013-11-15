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
class EventBookingViewRegistrationCancel extends JView
{
	function display($tpl = null)
	{	
	    $this->setLayout('default') ;
		$db = & JFactory::getDBO();	
		$id = JRequest::getInt('id', 0) ;
		$config = EventBookingHelper::getConfig() ;		
		$sql = 'SELECT * FROM #__eb_registrants WHERE id='.$id;
		$db->setQuery($sql) ;	
		$row = $db->loadObject();
		if ($row->amount > 0) {
			$message = $config->registration_cancel_message_paid ;
		} else {
			$message = $config->registration_cancel_message_free ;
		}					
		if ($id > 0) {
			$db = & JFactory::getDBO() ;
			$sql = 'SELECT a.title FROM #__eb_events AS a INNER JOIN #__eb_registrants AS b ON a.id=b.event_id WHERE b.id='.$id;
			$db->setQuery($sql) ;
			$title = $db->loadResult();
			$message = str_replace('[EVENT_TITLE]', $title, $message) ;
		}
		$this->assignRef('message', $message);				
		parent::display($tpl);				
	}
}