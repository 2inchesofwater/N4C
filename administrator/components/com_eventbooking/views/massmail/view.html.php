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
class EventBookingViewMassmail extends JView
{
	function display($tpl = null)
	{				
		$db = & JFactory::getDBO() ;
		$config = EventBookingHelper::getConfig();		
	    $options = array() ;
		$options[] = JHTML::_('select.option', -1, JText::_('EB_SELECT_EVENT'), 'id', 'title') ;
		$sql = 'SELECT id, title, event_date FROM #__eb_events WHERE published=1 ORDER BY title, ordering' ;
		$db->setQuery($sql) ;
		if ($config->show_event_date) {
			$rows = $db->loadObjectList ();
			for($i = 0, $n = count ( $rows ); $i < $n; $i ++) {
				$row = $rows [$i];
				$options [] = JHTML::_ ( 'select.option', $row->id, $row->title . ' (' . JHTML::_ ( 'date', $row->event_date, $config->date_format ) . ')' . '', 'id', 'title' );
			}
		} else {
			$options = array_merge ( $options, $db->loadObjectList () );
		}		
		$lists['event_id'] = JHTML::_('select.genericlist', $options, 'event_id', 'class="inputbox" ', 'id', 'title', JRequest::getInt('event_id')) ;
		$this->assignRef('lists', $lists);					
		parent::display($tpl);				
	}
}