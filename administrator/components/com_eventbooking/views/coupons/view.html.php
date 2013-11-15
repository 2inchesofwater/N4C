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
class EventBookingViewCoupons extends JView
{
	function display($tpl = null)
	{		
		$mainframe = & JFactory::getApplication() ;
		$option    = 'com_eventbooking' ;							
		$db = & JFactory::getDBO() ;
		$dateFormat = EventBookingHelper::getConfigValue('date_format');
		$nullDate = $db->getNullDate() ;		
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'coupons_filter_order',		'filter_order',		'a.code',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$filter_state		= $mainframe->getUserStateFromRequest( $option.'coupons_filter_state',	'filter_state',	'');
		
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );						
		$lists['search'] = $search;	
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_STATUS'));
		$options[] = JHTML::_('select.option', 1, JText::_('EB_PUBLISHED'));
		$options[] = JHTML::_('select.option', 0, JText::_('EB_UNPUBLISHED'));
		$lists['filter_state'] = JHTML::_('select.genericlist', $options, 'filter_state', ' class="inputbox" onchange="submit();" ', 'value', 'text', $filter_state);
		
		
		$items		= & $this->get( 'Data');		
		$pagination = & $this->get( 'Pagination' );	
		$discountTypes = array(0 => '%', 1 => EventBookingHelper::getConfigValue('currency_symbol')) ;		
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);	
		$this->assignRef('discountTypes', $discountTypes) ;
		$this->assignRef('nullDate', $nullDate) ;		
		$this->assignRef('dateFormat', $dateFormat) ;
		parent::display($tpl);				
	}
}