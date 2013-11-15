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
 * @subpackage	Event Booking
 * @since 1.0
 */
class EventBookingViewRegistrant extends JView
{
	function display($tpl = null)
	{		
		EventBookingHelper::loadLanguage();
		$db = & JFactory::getDBO();
		$item = $this->get('Data');		
		$config = EventBookingHelper::getConfig() ;
		if (version_compare(JVERSION, '1.6.0', 'ge'))
		    $param = null ;
		else 
		    $param = 0 ;    
		$this->assignRef('item', $item);
		$this->assignRef('config', $config);
		//Build list of event dropdown
		$options = array() ;
		$sql = 'SELECT id, title, event_date FROM #__eb_events WHERE published=1 ORDER BY title';
		$db->setQuery($sql);
		$options[] = JHTML::_('select.option', 0, JText::_('Select Event'), 'id', 'title');		
        if ($config->show_event_date) {
            $rows = $db->loadObjectList() ;
            for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
                $row = $rows[$i] ;
                $options[] = JHTML::_('select.option', $row->id, $row->title.' ('.JHTML::_('date', $row->event_date, $config->date_format, $param).')'.'', 'id', 'title');
            }
        } else {
               $options = array_merge($options, $db->loadObjectList()) ;
        }		
		$lists['event_id'] = JHTML::_('select.genericlist', $options, 'event_id', ' class="inputbox" ', 'id', 'title', $item->event_id);		
		//Get list of country
		$sql = 'SELECT name AS value, name AS text FROM #__eb_countries ORDER BY name';
		$db->setQuery($sql);		
		$rowCountries = $db->loadObjectList();
		$options = array();		
		$options[] =  JHTML::_('select.option', '', JText::_('EB_SELECT_COUNTRY'));
		$options = array_merge($options, $rowCountries);
		$lists['country_list'] = JHTML::_('select.genericlist', $options, 'country', '', 'value', 'text', $item->country);
			
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$item->event_id ;
		$db->setQuery($sql) ;		
		$event = $db->loadObject();
		
		if (is_object($event)) {
			//Override the setting in Configuration area with event's settings
			$params = new JParameter($event->params) ;
			$keys = array('s_lastname', 'r_lastname', 's_organization', 'r_organization', 's_address', 'r_address', 's_address2', 'r_address2', 's_city', 'r_city', 's_state', 'r_state', 's_zip', 'r_zip', 's_country', 'r_country', 's_phone', 'r_phone', 's_fax', 'r_fax', 's_comment', 'r_comment');
			foreach ($keys as $key) {
				$config->$key = $params->get($key, 0) ;
			}				
			$keys = array('gr_lastname', 'gr_lastname', 'gs_organization', 'gr_organization', 'gs_address', 'gr_address', 'gs_address2', 'gr_address2', 'gs_city', 'gr_city', 'gs_state', 'gr_state', 'gs_zip', 'gr_zip', 'gs_country', 'gr_country', 'gs_phone', 'gr_phone', 'gs_fax', 'gr_fax', 'gs_email', 'gr_email', 'gs_comment', 'gr_comment');
			foreach ($keys as $key) {
				$config->$key = $params->get($key, 0) ;
			}
		}								
		if ($item->id) {//We only allow custom fields to be edited in case edit registrants. That's because we don't know this is individual or group registration until the information is saved
			if ($item->number_registrants > 1)
				$jcFields = new JCFields($item->event_id, false, 1) ;
			else 		
				$jcFields = new JCFields($item->event_id, false, 0) ;
			$this->assignRef('jcFields', $jcFields) ;								
		}				
		$options = array() ;
		$options[] = JHTML::_('select.option', 0, JText::_('Pending'));
		$options[] = JHTML::_('select.option', 1, JText::_('Paid'));
		$options[] = JHTML::_('select.option', 2, JText::_('Cancelled'));
		$lists['published'] = JHTML::_('select.genericlist', $options, 'published', ' class="inputbox" ', 'value', 'text', $item->published);
		#From version 1.3.2, added for supporting editing group members
		if ($item->id > 0) {
			$sql = 'SELECT * FROM #__eb_registrants WHERE `group_id`='.$item->id ;
			$db->setQuery($sql) ;
			$rowMembers = $db->loadObjectList();
		} else {
			$rowMembers = array();
		}		
		#Uncomment the below lines for backward compatibility		
		if (!$rowMembers && $item->number_registrants > 1) {
			$rowMembers = array() ;
			for ($i = 0 ; $i < $item->number_registrants; $i++) {
				//$rowMember = & $this->getTable('EventBooking', 'Registrant');
				$rowMember = & JTable::getInstance('EventBooking', 'Registrant');
				$rowMember->event_id = $item->event_id ;
				$rowMember->group_id = $item->id ;
				$rowMember->store();
				$rowMembers[] = $rowMember ;
			}
		}		
		
		$options = array() ;
		$options[] = JHTML::_('select.option', -1, JText::_('EB_PAYMENT_STATUS'));
		$options[] = JHTML::_('select.option', 0, JText::_('EB_PARTIAL_PAYMENT'));
		$options[] = JHTML::_('select.option', 1, JText::_('EB_FULL_PAYMENT'));        
		$lists['payment_status'] = JHTML::_('select.genericlist', $options, 'payment_status', ' class="inputbox" ', 'value', 'text', $item->payment_status);
		#
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_COUNTRY'));
		$sql = 'SELECT name AS `value`, name AS `text` FROM #__eb_countries ORDER BY name';
		$db->setQuery($sql) ;
		$options = array_merge($options, $db->loadObjectList()) ;
		$this->assignRef('item', $item);
		$this->assignRef('event', $event) ;
		$this->assignRef('config', $config);
		$this->assignRef('lists', $lists);	
		$this->assignRef('rowMembers', $rowMembers) ;						
		$this->assignRef('options', $options) ;		
		parent::display($tpl);				
	}
}