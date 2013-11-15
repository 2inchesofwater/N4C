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
class EventBookingViewFields extends JView
{
	function display($tpl = null)
	{		
		$mainframe = & JFactory::getApplication() ;
		$option    = 'com_eventbooking' ;								
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'field_filter_order',		'filter_order',		'a.id',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );										
		$showCoreField		= $mainframe->getUserStateFromRequest( $option.'show_core_field',			'show_core_field',			1,				'int' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$filter_state		= $mainframe->getUserStateFromRequest( $option.'fields_filter_state',	'filter_state',	'');
		$search				= JString::strtolower( $search );
		$eventId				= $mainframe->getUserStateFromRequest( $option.'event_id',			'event_id',			0,				'int' );
		$db = & JFactory::getDBO();					
		$lists['search'] = $search;	
		
		//Get list of events
		$sql = 'SELECT id, title, event_date FROM #__eb_events WHERE published = 1 ORDER BY title';
		$db->setQuery($sql) ;
		$options = array() ;
		$options[] = JHTML::_('select.option', 0, JText::_('EB_ALL_EVENTS'), 'id', 'title') ;
		if (version_compare(JVERSION, '1.6.0', 'ge'))
		    $param = null ;
		else 
		    $param = 0 ;    
        if ($config->show_event_date) {
            $rows = $db->loadObjectList() ;
            for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
                $row = $rows[$i] ;
                $options[] = JHTML::_('select.option', $row->id, $row->title.' ('.JHTML::_('date', $row->event_date, $config->date_format, $param).')'.'', 'id', 'title');
            }
        } else {
               $options = array_merge($options, $db->loadObjectList()) ;
        }								
		$lists['event_id'] = JHTML::_('select.genericlist', $options, 'event_id', 'class="inputbox" onchange="submit();" ', 'id', 'title', $eventId) ;

		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_STATUS'));
		$options[] = JHTML::_('select.option', 1, JText::_('EB_PUBLISHED'));
		$options[] = JHTML::_('select.option', 0, JText::_('EB_UNPUBLISHED'));
		$lists['filter_state'] = JHTML::_('select.genericlist', $options, 'filter_state', ' class="inputbox" onchange="submit();" ', 'value', 'text', $filter_state);
		
		$items		= & $this->get( 'Data');		
		$pagination = & $this->get( 'Pagination' );		
		$lists['order_Dir'] = $filter_order_Dir ;
		$lists['order'] = $filter_order ;			
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);				
		parent::display($tpl);				
	}	
}