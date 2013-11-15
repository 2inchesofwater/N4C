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
	    $this->setLayout('default') ;
		EventBookingHelper::checkEditRegistrant();
		$db = & JFactory::getDBO();
		$user = & JFactory::getUser() ;
		$item = $this->get('Data');		
		$config = EventBookingHelper::getConfig() ;
		$userId = $user->get('id');
		$this->assignRef('item', $item);
		$this->assignRef('config', $config);
		//Get list of country
		$sql = 'SELECT name AS value, name AS text FROM #__eb_countries ORDER BY name';
		$db->setQuery($sql);		
		$rowCountries = $db->loadObjectList();
		$options = array();		
		$options[] =  JHTML::_('select.option', '', JText::_('Select country'));
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$item->event_id ;
		$db->setQuery($sql) ;		
		$event = $db->loadObject();
		if (is_object($event)) {
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
		$options = array_merge($options, $rowCountries);
		if ($item->id) {
			if ($item->number_registrants > 1)
				$jcFields = new JCFields($item->event_id, false, 1) ;
			else 		
				$jcFields = new JCFields($item->event_id, false, 0) ;			
			$this->assignRef('jcFields', $jcFields) ;								
		}		
		$lists['country_list'] = JHTML::_('select.genericlist', $options, 'country', '', 'value', 'text', $item->country);
		$from =  JRequest::getVar('from', '');
		//Get list of members
		$sql = 'SELECT * FROM #__eb_registrants WHERE `group_id`='.$item->id ;
		$db->setQuery($sql) ;
		$rowMembers = $db->loadObjectList();			
		
		$registrantAccessUserIds = EventBookingHelper::getConfigValue('registrant_access_user_ids');
		$registrantAccessUserIds = explode(',', $registrantAccessUserIds) ;		
		if ($userId && in_array($userId, $registrantAccessUserIds) && ( strpos($item->payment_method, 'os_offline') !== false)) {			
			$canChangeStatus = true ;
			$options = array() ;
			$options[] = JHTML::_('select.option', 0, JText::_('Pending'));
			$options[] = JHTML::_('select.option', 1, JText::_('Paid'));
			$options[] = JHTML::_('select.option', 2, JText::_('Cancelled'));
			$lists['published'] = JHTML::_('select.genericlist', $options, 'published', ' class="inputbox" ', 'value', 'text', $item->published);							
		} else {
			$canChangeStatus = false ;
		}							
		$this->assignRef('item', $item);
		$this->assignRef('event', $event) ;
		$this->assignRef('config', $config);
		$this->assignRef('lists', $lists);	
		$this->assignRef('rowMembers', $rowMembers) ;						
		$this->assignRef('options', $options) ;
		$this->assignRef('from', $from) ;
		$this->assignRef('canChangeStatus', $canChangeStatus) ;
		parent::display($tpl);				
	}
}