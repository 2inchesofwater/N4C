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
class EventBookingViewCoupon extends JView{
	function display($tpl = null){
		$db = JFactory::getDBO();
		$nullDate = $db->getNullDate() ;
		$item = $this->get('Data');								
		$options = array();	
		$options[] = JHTML::_('select.option', 0, JText::_('%')); 
		$options[] = JHTML::_('select.option', 1, EventBookingHelper::getConfigValue('currency_symbol')); 
		$lists['coupon_type'] = JHTML::_('select.genericlist', $options, 'coupon_type', 'class="inputbox"', 'value', 'text', $item->coupon_type);		
		$options = array();
		$options[] = JHTML::_('select.option', 0, 'All Events', 'id', 'title'); 
		$db->setQuery("SELECT id, title FROM #__eb_events WHERE published = 1 ORDER BY title");
		$options = array_merge($options, $db->loadObjectList()) ;		
		$lists['event_id'] =	JHTML::_('select.genericlist', $options, 'event_id', 'class="inputbox"', 'id', 'title', $item->event_id);						
		$lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published);																																																																															
		$this->assignRef('item', $item);						
		$this->assignRef('lists', $lists);
		$this->assignRef('nullDate', $nullDate) ;			
		parent::display($tpl);				
	}
}