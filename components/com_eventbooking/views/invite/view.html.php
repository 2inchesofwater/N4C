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
 * HTML View class for Event Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingViewInvite extends JView
{
	function display($tpl = null)
	{					
		$layout = $this->getLayout() ;
		if ($layout == 'complete') {
			$this->_displayInviteComplete($tpl);
		} else {
			$db = & JFactory::getDBO();
			$user = & JFactory::getUser() ;
			$config = EventBookingHelper::getConfig() ;
			$eventId = JRequest::getInt('id', 0);				
			$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
			$db->setQuery($sql) ;
			$event = $db->loadObject();										
			$this->assignRef('event', $event) ;																	
			$this->assignRef('config', $config) ;
			$this->assignRef('user', $user) ;									
			parent::display($tpl);
		}																		
	}
	/**
	 * Display invitation complete message	
	 * @param string $tpl
	 */
	function _displayInviteComplete($tpl) {
		$message = EventBookingHelper::getConfigValue('invitation_complete');
		$this->assignRef('message', $message) ;		
		parent::display($tpl);
	}
}