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
 * HTML View class for EventBooking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Events Booking
 * @since 1.5
 */
class EventBookingViewRegistrantList extends JView
{
	function display($tpl = null)
	{		
		if (!EventBookingHelper::canViewRegistrantList()) {
			return ;
		}
		$config = EventBookingHelper::getConfig() ;
	    $this->setLayout('default') ;
		$db = & JFactory::getDBO();
		$eventId = JRequest::getInt('event_id');
		$config = EventBookingHelper::getConfig();
		if ($eventId) {
			if (isset($config->include_group_billing_in_registrants) && !$config->include_group_billing_in_registrants)				
				$sql = 'SELECT * FROM #__eb_registrants WHERE event_id='.$eventId.' AND is_group_billing=0 AND (published=1 OR (payment_method LIKE "os_offline%" AND published != 2)) ORDER BY register_date DESC';
			else
				$sql = 'SELECT * FROM #__eb_registrants WHERE event_id='.$eventId.' AND (published=1 OR (payment_method LIKE "os_offline%" AND published != 2)) ORDER BY register_date DESC';			
			$db->setQuery($sql) ;
			$rows = $db->loadObjectList();
		} else {			
			$rows = array() ;
		}
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId;
		$db->setQuery($sql);
		$event = $db->loadObject() ;
		if (strlen(trim($event->custom_field_ids))) {
			$fields = explode(',', $event->custom_field_ids);
			$fieldTitles = array();
			$fieldValues = array();
			$sql = 'SELECT id, title FROM #__eb_fields WHERE id IN ('.$event->custom_field_ids.')';
			$db->setQuery($sql) ;
			$rowFields = $db->loadObjectList();
			foreach($rowFields as $rowField) {
				$fieldTitles[$rowField->id] = $rowField->title ;
			}

			$registrantIds = array();
			foreach ($rows as $row) {
				$registrantIds[] = $row->id ;
			}			
			$sql = 'SELECT registrant_id, field_id, field_value FROM #__eb_field_values WHERE registrant_id IN ('.implode(',', $registrantIds).')';
			$db->setQuery($sql);
			$rowFields = $db->loadObjectList();
			foreach ($rowFields as $rowField) {
				$fieldValues[$rowField->registrant_id][$rowField->field_id] = $rowField->field_value ;
			}
			
			$this->assignRef('fieldTitles', $fieldTitles) ;
			$this->assignRef('fieldValues', $fieldValues) ;
			$this->assignRef('fields', $fields) ;
			$displayCustomField = true ;
		} else {
			$displayCustomField = false ;
		}
						
		$this->assignRef('items', $rows) ;
		$this->assignRef('config', $config) ;
		$this->assignRef('displayCustomField', $displayCustomField) ;
		
		parent::display($tpl);				
	}
}