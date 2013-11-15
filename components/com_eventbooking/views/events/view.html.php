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
 * HTML View class for the Event Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.0
 */
class EventBookingViewEvents extends JView
{
	function display($tpl = null)
	{		
	    $this->setLayout('default') ;
		$mainframe = & JFactory::getApplication() ;			
		$user = & JFactory::getUser() ;			
		$db = & JFactory::getDBO() ;
		if ($user->get('guest')) {
		    $mainframe->redirect('index.php', JText::_("EB_NO_PERMISSION")) ;
		    return ;
		}
		$nullDate = $db->getNullDate();																					
		$items = & $this->get('Data');				
		$pagination = & $this->get('Pagination');						
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
		$this->assignRef('items', $items) ;											
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('Itemid', $Itemid) ;
		$this->assignRef('config', $config) ;		
		$this->assignRef('nullDate', $nullDate) ;		
		parent::display($tpl) ;				
	}
}