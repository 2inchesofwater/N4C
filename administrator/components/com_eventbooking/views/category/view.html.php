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
 * @subpackage	EventBooking
 * @since 1.5
 */
class EventBookingViewCategory extends JView
{
	function display($tpl = null)
	{				
		$db = & JFactory::getDBO() ;
		$item = $this->get('Data');			
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('Default Layout')) ;
		$options[] = JHTML::_('select.option', 'table', JText::_('Table Layout')) ;
		$options[] = JHTML::_('select.option', 'calendar', JText::_('Calendar Layout')) ;				
		$lists['layout'] = JHTML::_('select.genericlist', $options, 'layout', ' class="inputbox" ', 'value', 'text', $item->layout) ;	
		$lists['parent'] = EventBookingHelper::parentCategories($item) ;			
		$lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published);
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $lists['access'] = JHtml::_('access.level', 'access', $item->access, ' class="inputbox" ', false);   
		} else {		    
		    $sql = 'SELECT id AS value, name AS text'
    		. ' FROM #__groups'
    		. ' ORDER BY id'
    		;
    		$db->setQuery($sql) ;
    		$groups = $db->loadObjectList();		
    		$lists['access'] = JHTML::_('select.genericlist',   $groups, 'access', 'class="inputbox" ', 'value', 'text', $item->access) ; 
		}						
		$this->assignRef('item', $item);						
		$this->assignRef('lists', $lists);			
		parent::display($tpl);				
	}
}