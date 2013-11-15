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
class EventBookingViewField extends JView
{
	function display($tpl = null)
	{			
		$db = & JFactory::getDBO();
		$config = EventBookingHelper::getConfig() ;
		$item = $this->get('Data');
		$sql = 'SELECT id, name FROM #__eb_field_types';
		$db->setQuery($sql) ;			
		$options = array() ;
		$options[] = JHTML::_('select.option', -1, JText::_('EB_FIELD_TYPE'), 'id', 'name') ;
		$options = array_merge($options, $db->loadObjectList()) ;					
		$lists['field_type'] = JHTML::_('select.genericlist', $options, 'field_type',' class="inputbox" ', 'id', 'name', $item->field_type);
		if (version_compare(JVERSION, '1.6.0', 'ge'))
		    $param = null ;
		else 
		    $param = 0 ;    
		$options = array() ;
		$options[] = JHTML::_('select.option', -1, JText::_('EB_ALL_EVENTS'), 'id', 'title') ;
		$sql = 'SELECT id, title, event_date FROM #__eb_events WHERE published=1 ORDER BY title, ordering' ;
		$db->setQuery($sql) ;
		if ($config->show_event_date) {
			$rows = $db->loadObjectList ();
			for($i = 0, $n = count ( $rows ); $i < $n; $i ++) {
				$row = $rows [$i];
				$options [] = JHTML::_ ( 'select.option', $row->id, $row->title . ' (' . JHTML::_ ( 'date', $row->event_date, $config->date_format, $param ) . ')' . '', 'id', 'title' );
			}
		} else {
			$options = array_merge ( $options, $db->loadObjectList () );
		}					
		$selecteds = array() ;
		if ($item->id) {
			if ($item->event_id == -1) {
				$selecteds[] = JHTML::_('select.option', -1, -1, 'id', 'title');
			} else {
				$sql = 'SELECT event_id FROM #__eb_field_events WHERE field_id='.$item->id ;
				$db->setQuery($sql) ;
				$rowFields = $db->loadObjectList();
				for ($i = 0 , $n = count($rowFields) ; $i < $n ; $i++) {
					$rowField = $rowFields[$i] ;
					$selecteds[] = JHTML::_('select.option', $rowField->event_id, $rowField->event_id, 'id', 'title');
				}
			}				
		}				
		$lists['event_id'] = JHTML::_('select.genericlist', $options, 'event_id[]', 'class="inputbox" multiple="multiple" size="5" ', 'id', 'title', $selecteds) ;								
		$lists['required'] = JHTML::_('select.booleanlist', 'required', ' class="inputbox" ', $item->required) ;
		$lists['published'] = JHTML::_('select.booleanlist', 'published', ' class="inputbox" ', $item->published) ;
		$lists['fee_field'] = JHTML::_('select.booleanlist', 'fee_field', ' class="inputbox" ', $item->fee_field) ;			
		$integration = EventBookingHelper::getConfigValue('cb_integration') ;
		if ($integration) {
			if ($integration == 1) {
				$sql = 'SELECT name AS `value`, name AS `text` FROM #__comprofiler_fields WHERE `table`="#__comprofiler"';	
			} elseif ($integration == 2) {
				$sql = 'SELECT fieldcode AS `value`, fieldcode AS `text` FROM #__community_fields WHERE published=1 AND fieldcode != ""' ;				
			}		
			$db->setQuery($sql) ;		
			$options = array() ;
			$options[] = JHTML::_('select.option', '', JText::_('Select Field')) ;
			$options = array_merge($options, $db->loadObjectList()) ;
			$lists['field_mapping'] = JHTML::_('select.genericlist', $options, 'field_mapping', ' class="inputbox" ', 'value', 'text', $item->field_mapping) ;	
		}
					
		$options = array() ;
				
		$options[] = JHTML::_('select.option', 0 , JText::_('EB_ALL')) ;
		$options[] = JHTML::_('select.option', 1 , JText::_('EB_INDIVIDUAL_BILLING')) ;
		$options[] = JHTML::_('select.option', 2 , JText::_('EB_GROUP_BILLING')) ;
		$options[] = JHTML::_('select.option', 3 , JText::_('EB_INDIVIDUAL_GROUP_BILLING')) ;
		$options[] = JHTML::_('select.option', 4 , JText::_('EB_GROUP_MEMBER_FORM')) ;
		$options[] = JHTML::_('select.option', 5 , JText::_('EB_GROUP_MEMBER_INDIVIDUAL')) ;
					
		$lists['display_in'] = JHTML::_('select.genericlist', $options, 'display_in', ' class="inputbox" ', 'value', 'text', $item->display_in) ;				
		$this->assignRef('item', $item);				
		$this->assignRef('integration', $integration) ;
		$this->assignRef('lists', $lists );		
		parent::display($tpl);				
	}
}