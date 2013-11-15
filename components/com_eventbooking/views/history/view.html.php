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
class EventBookingViewHistory extends JView
{
	function display($tpl = null)
	{		
		EventBookingHelper::checkAccessHistory();
		$mainframe = & JFactory::getApplication() ;
		$option    = 'com_eventbooking' ;    									
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'registrant_filter_order', 'filter_order', 'a.payment_date', 'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'DESC', 'word');												
		// search for word
		$search				= $mainframe->getUserStateFromRequest( $option.'search', 'search', '', 'string');
		$eventId			= $mainframe->getUserStateFromRequest( $option.'event_id',			'event_id',			0,				'int' );
		$search				= JString::strtolower( $search );		
		$lists['search'] = $search;	
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;						
		//Get list of document		
		$db = & JFactory::getDBO();
		$sql = 'SELECT id, title FROM #__eb_events WHERE published = 1 ORDER BY title';
		$db->setQuery($sql) ;
		$options = array() ;
		$options[] = JHTML::_('select.option', 0, JText::_('Select Event'), 'id', 'title') ;
		$options = array_merge($options, $db->loadObjectList()) ;
		$lists['event_id'] = JHTML::_('select.genericlist', $options, 'event_id', ' class="inputbox" onchange="submit();"', 'id', 'title', $eventId) ;		
		$items		= & $this->get( 'Data');		
		$pagination = & $this->get( 'Pagination' );				
		$config = EventBookingHelper::getConfig() ;
		$Itemid = JRequest::getInt('Itemid', 0);
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('config', $config) ;
		$this->assignRef('Itemid', $Itemid) ;	
		parent::display($tpl);				
	}
}