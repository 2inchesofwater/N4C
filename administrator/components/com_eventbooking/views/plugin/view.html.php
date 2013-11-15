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
 * HTML View class for Events Booking Extension
 *
 * @static
 * @package		Joomla
 * @subpackage	Events Booking
 * @since 1.0
 */
class EventBookingViewPlugin extends JView
{
	function display($tpl = null)
	{						
		$item = $this->get('Data');		
		$lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published);
		$params = new JParameter( $item->params, JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'payments'.DS.$item->name.'.xml');									
		$this->assignRef('item', $item);	
		$this->assignRef('lists', $lists) ;		
		$this->assignRef('params', $params) ;									
		parent::display($tpl);				
	}
}