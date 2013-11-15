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
class EventBookingViewMap extends JView
{
	function display($tpl = null)
	{					
	    $this->setLayout('default') ;	
		JHTML::_('behavior.mootools');				
		$db = & JFactory::getDBO();
		$config = EventBookingHelper::getConfig() ;
		$locationId = JRequest::getInt('location_id', 0) ;		
		$sql = 'SELECT * FROM #__eb_locations WHERE id='.$locationId ;
		$db->setQuery($sql) ;
		$location = $db->loadObject();							
		$this->assignRef('location', $location) ;																	
		$this->assignRef('config', $config) ;									
		parent::display($tpl);										
	}					
}