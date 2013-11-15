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
class EventBookingViewWaiting extends JView
{
	function display($tpl = null)
	{		
		EventBookingHelper::loadLanguage();
		$db = & JFactory::getDBO();
		$item = $this->get('Data');		
		$config = EventBookingHelper::getConfig() ;
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $param = null ;
		} else {
		    $param = 0 ;
		}
		$this->assignRef('item', $item);
		$this->assignRef('config', $config);
		//Build list of event dropdown
		$options = array() ;
		$sql = 'SELECT id, title, event_date FROM #__eb_events WHERE published=1 ORDER BY title';
		$db->setQuery($sql);
		$options[] = JHTML::_('select.option', 0, JText::_('Select Event'), 'id', 'title');		
        if ($config->show_event_date) {
            $rows = $db->loadObjectList() ;
            for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
                $row = $rows[$i] ;
                $options[] = JHTML::_('select.option', $row->id, $row->title.' ('.JHTML::_('date', $row->event_date, $config->date_format, $param).')'.'', 'id', 'title');
            }
        } else {
               $options = array_merge($options, $db->loadObjectList()) ;
        }		
		$lists['event_id'] = JHTML::_('select.genericlist', $options, 'event_id', ' class="inputbox" ', 'id', 'title', $item->event_id);		
		//Build list of user name dropdown
		$options = array() ;
		$sql = 'SELECT id, name FROM #__users ORDER BY name';
		$db->setQuery($sql);
		$options[] = JHTML::_('select.option', 0, JText::_('Select User'), 'id', 'name');		
        $options = array_merge($options, $db->loadObjectList()) ;               	
		$lists['user_id'] = JHTML::_('select.genericlist', $options, 'user_id', ' class="inputbox" ', 'id', 'name', $item->user_id);
		//Get list of country
		$sql = 'SELECT name AS value, name AS text FROM #__eb_countries ORDER BY name';
		$db->setQuery($sql);		
		$rowCountries = $db->loadObjectList();
		$options = array();		
		$options[] =  JHTML::_('select.option', '', JText::_('EB_SELECT_COUNTRY'));
		$options = array_merge($options, $rowCountries);
		$lists['country_list'] = JHTML::_('select.genericlist', $options, 'country', '', 'value', 'text', $item->country);
			
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$item->event_id ;
		$db->setQuery($sql) ;		
		$event = $db->loadObject();
																	
		//get list notified
		$lists['notified'] = JHTML::_('select.booleanlist', 'notified', ' class="inputbox" ', $item->notified);
					
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_COUNTRY'));
		$sql = 'SELECT name AS `value`, name AS `text` FROM #__eb_countries ORDER BY name';
		$db->setQuery($sql) ;
		$options = array_merge($options, $db->loadObjectList()) ;
		$this->assignRef('item', $item);
		$this->assignRef('event', $event) ;
		$this->assignRef('config', $config);
		$this->assignRef('lists', $lists);						
		$this->assignRef('options', $options) ;		
		$this->assignRef('param', $param) ;
		parent::display($tpl);				
	}
}