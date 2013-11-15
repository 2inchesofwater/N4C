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
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingViewLocation extends JView
{	
	function display($tpl = null)
	{				
	    $this->setLayout('default') ;				
		$mainframe = & JFactory::getApplication() ;				
		$db = & JFactory::getDBO() ;
		$nullDate = $db->getNullDate();
		$document = & JFactory::getDocument();						
		$pathway =& $mainframe->getPathway();														
		$items = & $this->get('Data');				
		$pagination = & $this->get('Pagination');
		$location = & $this->get('Location');
		$document->setTitle($location->name);					
		$config = EventBookingHelper::getConfig();	
		$j15 = version_compare(JVERSION, '1.6.0', 'ge') ? false : true ;	
		if ($config->process_plugin) {
		    if ($j15) {
		        $dispatcher = & JDispatcher::getInstance();
    			JPluginHelper::importPlugin('content');
    			$params = new JParameter('');
    			$limitstart = 0 ;
    			$article = new stdClass ;
    			$article->catid = 0 ; 
    			$article->sectionid = 0;    
		    }			
			for ($i = 0, $n = count($items) ; $i < $n ; $i++) {
				$item = & $items[$i] ;
				if ($j15) {
				    $article->text = $item->short_description ;
    				$dispatcher->trigger('onPrepareContent', array (& $article, & $params, $limitstart));
    				$item->short_description = $article->text ;    
				} else {
				    $item->short_description = JHtml::_('content.prepare', $item->short_description);
				}								 	
			}				
		}
		$Itemid = JRequest::getInt('Itemid', 0) ;												
		$user = & JFactory::getUser();
		$userId = $user->get('id');
		if ($j15) {
		    $aid = $user->get('aid');
		    $this->assignRef('aid', $aid) ;    
		} else {
		    $viewLevels = $user->getAuthorisedViewLevels() ;
		    $this->assignRef('viewLevels', $viewLevels) ;
		}						
		$this->assignRef('userId', $userId) ;		
		$this->assignRef('items', $items) ;											
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('Itemid', $Itemid) ;
		$this->assignRef('config', $config) ;
		$this->assignRef('location', $location) ;
		$this->assignRef('nullDate', $nullDate) ;		
		parent::display($tpl) ;									
	}	
}