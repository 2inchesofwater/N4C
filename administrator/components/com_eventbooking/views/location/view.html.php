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
class EventBookingViewLocation extends JView
{
	function display($tpl = null)
	{					
		$db = & JFactory::getDBO() ;
		$item = $this->get('Data');
		$sql = 'SELECT name AS `value`, name AS `text` FROM #__eb_countries ORDER BY name ';
		$db->setQuery($sql) ;
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('Select Country')) ;
		$options =  array_merge($options, $db->loadObjectList()) ;
		$lists['country'] = JHTML::_('select.genericlist', $options, 'country', ' class="inputbox" ', 'value', 'text', $item->country) ;
		$lists['published'] = JHTML::_('select.booleanlist', 'published', ' class="inputbox" ', $item->published) ;				
		$this->assignRef('item', $item);
		$this->assignRef('lists', $lists) ;								
		parent::display($tpl);				
	}
}