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
class EventBookingViewCategories extends JView
{
	function display($tpl = null)
	{		
	    $this->setLayout('default') ;		
		$mainframe = & JFactory::getApplication() ;		
		$document = & JFactory::getDocument() ;
		$pathway = & $mainframe->getPathway();	
		$categoryId = JRequest::getInt('category_id', 0) ;
		//Set the category from ID here
		if (!$categoryId) {
			$menus = JSite::getMenu();
			$menu = $menus->getActive();
			if (is_object($menu)) {
			    if (version_compare(JVERSION, '1.6.0', 'ge')) {
			        $params = new JRegistry() ;
			        $params->loadString($menu->params) ;
			    } else {
			        $params = new JParameter($menu->params) ;   
			    }				
				$categoryId = $params->get('category_id', 0);
				if ($categoryId) {
					JRequest::setVar('category_id', $categoryId);				
				}
			}					
		}
		if ($categoryId) {
			EventBookingHelper::checkCategoryAccess($categoryId);
		}
		$items = & $this->get('Data');	
		$pagination = & $this->get('Pagination');
		$Itemid = JRequest::getInt('Itemid', 0) ;		
		$parents = & $this->get('parentCategories');
		$config = EventBookingHelper::getConfig();
		
		if (!$config->fix_breadcrumbs) {
			for ($i = count($parents)-1 ; $i > 0 ; $i--) {
				$parent = $parents[$i] ;
				if ($parent->total_children)
					$pathUrl = JRoute::_('index.php?option=com_eventbooking&view=categories&category_id='.$parent->id.'&Itemid='.$Itemid);
				else
					$pathUrl = JRoute::_('index.php?option=com_eventbooking&view=category&category_id='.$parent->id.'&Itemid='.$Itemid);
				$pathway->addItem($parent->name, $pathUrl);
			}
			if ($categoryId) {
				$pathway->addItem($parents[0]->name);
			}
		}				

		
		if ($categoryId) {
			$db = & JFactory::getDBO();
			$sql = 'SELECT * FROM #__eb_categories WHERE id='.$categoryId;
			$db->setQuery($sql) ;
			$rowCategory = $db->loadObject();
			$this->assignRef('category', $rowCategory) ;
			$pageTitle = JText::_('EB_SUB_CATEGORIES_PAGE_TITLE');
			$pageTitle =  str_replace('[CATEGORY_NAME]', $rowCategory->name, $pageTitle) ;			
			$document->setTitle($pageTitle);
		} else {			
			$document->setTitle(JText::_('EB_CATEGORIES_PAGE_TITLE'));	
		}		
		
				
		$config = EventBookingHelper::getConfig();		
		$this->assignRef('categoryId', $categoryId) ;
		$this->assignRef('config', $config) ;		
		$this->assignRef('items', $items) ;											
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('Itemid', $Itemid) ;		
		parent::display($tpl);				
	}
}