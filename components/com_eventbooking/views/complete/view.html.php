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

jimport( 'joomla.application.component.view') ;
/**
 * HTML View class for the Event Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	EventBooking
 * @since 1.0
 */
class EventBookingViewComplete extends JView
{
	function display($tpl = null)
	{	
		$this->setLayout('default') ;//Hardcoded the layout, it happens with some clients. Maybe it is a bug of Joomla core code, will find out it later
		$db = & JFactory::getDBO() ;		
		$registrationCode = JRequest::getVar('registration_code') ;
		if ($registrationCode) {
			$sql = 'SELECT id FROM #__eb_registrants WHERE registration_code="'.$registrationCode.'" ORDER BY id LIMIT 1 ';
			$db->setQuery($sql) ;
			$id = (int) $db->loadResult() ;
		} else {
			$id = 0 ;	
		}
											
		$sql = 'SELECT a.id, a.title, a.thanks_message, a.thanks_message_offline, b.payment_method FROM #__eb_events  AS a '
		. ' INNER JOIN #__eb_registrants AS b '
		. ' ON a.id = b.event_id '
		. ' WHERE b.id = '.$id		
		;	 		
		$db->setQuery($sql) ;
		$registrant = $db->loadObject();				
		$config = EventBookingHelper::getConfig() ;	
		//Override thanks message
		if (strlen(trim(strip_tags($registrant->thanks_message)))) {
			$config->thanks_message = $registrant->thanks_message ;
		}				
		if (strlen(trim(strip_tags($registrant->thanks_message_offline)))) {
			$config->thanks_message_offline = $registrant->thanks_message_offline ;
		}		
		if (strpos($registrant->payment_method, 'os_offline') !== false) {
			$message = $config->thanks_message_offline ;
		} else {
			$message = $config->thanks_message ;
		}				
		if ($config->multiple_booking) {
			$sql = 'SELECT event_id FROM #__eb_registrants WHERE id='.$id.' OR cart_id='.$id.' ORDER BY id' ;
			$db->setQuery($sql) ;
			$eventIds = $db->loadResultArray();
			$sql = 'SELECT title FROM #__eb_events WHERE id IN ('.implode(',', $eventIds).') ORDER BY FIND_IN_SET(id, "'.implode(',', $eventIds).'")';
			$db->setQuery($sql) ;
			$eventTitles = $db->loadResultArray();
			$eventTitle = implode(', ', $eventTitles) ;
			$message = str_replace('[EVENT_TITLE]', $eventTitle, $message) ;	
		} else {
			$message = str_replace('[EVENT_TITLE]', $registrant->title, $message) ;	
		}		
		$sql = 'SELECT * FROM #__eb_registrants WHERE id='.$id ;
		$db->setQuery($sql) ;
		$row = $db->loadObject();
		$registrationDetail = EventBookingHelper::getEmailContent($config, $row) ;
		$message = str_replace('[REGISTRATION_DETAIL]', $registrationDetail, $message) ;		
						
		//Support other tags here
		$replaces = array() ;							
		$replaces['first_name'] = $row->first_name ;
		$replaces['last_name'] = $row->last_name ;
		$replaces['organization'] = $row->organization ;
		$replaces['address'] = $row->address ;
		$replaces['address2'] = $row->address ;
		$replaces['city'] = $row->city ;
		$replaces['state'] = $row->state ;
		$replaces['zip'] = $row->zip ;
		$replaces['country'] = $row->country ;
		$replaces['phone'] = $row->phone ;
		$replaces['fax'] = $row->phone ;
		$replaces['email'] = $row->email ;
		$replaces['comment'] = $row->comment ;
		$replaces['amount'] = number_format($row->amount, 2) ;
		
		foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$message = str_replace("[$key]", $value, $message) ;
		}
						
		$this->assignRef('message', $message);						
		parent::display($tpl);				
	}
}