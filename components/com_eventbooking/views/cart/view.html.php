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
 * @since 1.0
 */
class EventBookingViewCart extends JView
{
	/**
	 * Display interface to user
	 *
	 * @param string $tpl
	 */
	function display($tpl = null)
	{							
	    $this->setLayout('default') ;
		$Itemid = JRequest::getInt('Itemid');
		$config = EventBookingHelper::getConfig();		
		$url = JURI::base() ;
		if ($config->use_https) {
			$url = str_replace('http:', 'https:', $url) ;				
		}
		if (isset($_SESSION['last_category_id'])) {
			$categoryId = $_SESSION['last_category_id'] ;
		} else {
			//Get category ID of the current event
			require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';
			$cart = new EBCart() ;
			$eventIds = $cart->getItems();
			if (count($eventIds)) {
				$db = & JFactory::getDBO() ;
				$lastEventId = $eventIds[count($eventIds) - 1] ;
				$sql = 'SELECT category_id FROM #__eb_event_categories WHERE event_id='.$lastEventId ;
				$db->setQuery($sql) ;
				$categoryId = $db->loadResult();
			} else {
				$categoryId = 0 ;
			}
		}						
		$items = $this->get('Data') ;
		//Generate javascript string
		$jsString = " var arrEventIds = new Array() \n; var arrQuantities = new Array();\n" ;			
		for ($i = 0 , $n = count($items) ; $i < $n ; $i++) {
			$item = $items[$i] ;
			if ($item->event_capacity == 0) {
				$availbleQuantity = -1 ;
			} else {
				$availbleQuantity = $item->event_capacity - $item->total_registrants ;
			}
			$jsString .= "arrEventIds[$i] = $item->id ;\n";
			$jsString .= "arrQuantities[$i] = $availbleQuantity ;\n";			
		}							
		$this->assignRef('items', $items) ;
		$this->assignRef('config', $config) ;
		$this->assignRef('categoryId', $categoryId) ;
		$this->assignRef('url', $url) ;
		$this->assignRef('Itemid', $Itemid) ;		
		$this->assignRef('jsString', $jsString) ;
		parent::display($tpl) ;					
	}	
}