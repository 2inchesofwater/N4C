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
class EventBookingViewCategory extends JView
{	
	function display($tpl = null)
	{								
		$mainframe = & JFactory::getApplication() ;				
		$db = & JFactory::getDBO() ;
		$nullDate = $db->getNullDate();
		$document = & JFactory::getDocument();						
		$pathway =& $mainframe->getPathway();										
		$categoryId = JRequest::getInt('category_id', 0) ;
		$j15 = version_compare(JVERSION, '1.6.0', 'ge') ? false : true ;
		if (!$categoryId) {
			$menus = JSite::getMenu();
			$menu = $menus->getActive();
			if (is_object($menu)) {
			    if ($j15) {
			        $params = new JParameter($menu->params) ;
			    } else {
			        $params = new JRegistry() ;
			        $params->loadString($menu->params) ;			          
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
		$category = & $this->get('Category');
		$pageTitle = JText::_('EB_CATEGORY_PAGE_TITLE');
		$pageTitle = str_replace('[CATEGORY_NAME]', $category->name, $pageTitle);
		$document->setTitle($pageTitle);					
		$config = EventBookingHelper::getConfig();		
		if ($config->process_plugin) {
			$dispatcher = & JDispatcher::getInstance();
			JPluginHelper::importPlugin('content');
			$params = new JParameter('');
			$limitstart = 0 ;
			$article = new stdClass ;
			$article->catid = 0 ; 
			$article->sectionid = 0;
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
		$parents = & $this->get('parentCategories');
		
		if (!$config->fix_breadcrumbs) {
			for ($i = count($parents)-1 ; $i > 0 ; $i--) {
				$parent = $parents[$i] ;
				if ($parent->total_children)
					$pathUrl = JRoute::_('index.php?option=com_eventbooking&view=categories&category_id='.$parent->id.'&Itemid='.$Itemid);
				else
					$pathUrl = JRoute::_('index.php?option=com_eventbooking&view=category&category_id='.$parent->id.'&Itemid='.$Itemid);
				$pathway->addItem($parent->name, $pathUrl);
			}
			$pathway->addItem($category->name);
		}

		
		$user = & JFactory::getUser();
		$userId = $user->get('id');		
		$_SESSION['last_category_id'] = $categoryId ;		
		//Override layout for this category
		$layout = $this->getLayout();
		if ($layout == '' || $layout == 'default') {
			if ($category->layout) {			
				$this->setLayout($category->layout) ;							
			}	
		}
		$layout = $this->getLayout();
		if ($layout == 'calendar') {
			$this->_displayCalendarView($tpl) ;
			return ;
		}			
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
		$this->assignRef('category', $category) ;
		$this->assignRef('nullDate', $nullDate) ;		
		parent::display($tpl) ;									
	}
	/**
	 * Display calendar view to user in a category
	 *
	 */
	function _displayCalendarView($tpl) {		
		$Itemid = JRequest::getInt('Itemid');
		$config = EventBookingHelper::getConfig() ;				
		$document = & JFactory::getDocument() ;
		if ($config->calendar_theme)
			$theme = $config->calendar_theme ;
		else 
			$theme = 'default' ;	
		$styleUrl = JURI::base(true).'/components/com_eventbooking/assets/css/themes/'.$theme.'.css';		
		$document->addStylesheet( $styleUrl, 'text/css', null, null );		
        //Initialize default month and year
        
		$menus = JSite::getMenu();
		$menu = $menus->getActive();
		if (is_object($menu)) {
		    if (version_compare(JVERSION, '1.6.0', 'ge')) {
		        $params = new JRegistry() ;
		        $params->loadString($menu->params) ;
		    } else {
		        $params = new JParameter($menu->params) ;   
		    }				
		    $month = JRequest::getInt('month');
		    $year = JRequest::getInt('year');
		    if (!$month) {
		         $month = (int)$params->get('default_month', 0);
		         if ($month)
			        JRequest::setVar('month', $month) ;   
		    }
		    if (!$year) {
		        $year = (int) $params->get('default_year', 0);			
			    if ($year)
			        JRequest::setVar('year', $year) ;    
		    }								    
		}		
						
		$category = & $this->get('Category');
		$model = & $this->getModel() ;
		list($year,$month,$day) = $model->_getYMD();		
		$this->data = $model->_getCalendarData($year, $month, $day );
		$this->month = $month;
		$this->year = $year;		
		$listmonth = array(JText::_('EB_JAN'), JText::_('EB_FEB'), JText::_('EB_MARCH'), JText::_('EB_APR'), JText::_('EB_MAY'), JText::_('EB_JUNE'), JText::_('EB_JULY'), JText::_('EB_AUG'), JText::_('EB_SEP'), JText::_('EB_OCT'),JText::_('EB_NOV'),JText::_('EB_DEC'));
		$option_month = array();
		foreach ($listmonth AS $key => $omonth){
			if ($key < 9){
				$value = "0".($key+1);
			}			
			else {
				 $value = $key + 1;
			}
			$option_month[] = JHTML::_('select.option',$value,$omonth);
		}
		$Itemid = JRequest::getVar('Itemid',0);
		$javascript = 'onchange="cal_date_change(this.value,'.$year.', '.$Itemid.');"';		
		$this->search_month = JHTML::_('select.genericlist',$option_month,'month','class="regpro_calendar_months" '.$javascript,'value','text',$month); 
		unset($option_month); unset($value); unset($omonth);
		
		$option_year = array();
		$javascript = 'onchange="cal_date_change('.$month.',this.value, '.$Itemid.');"';	
		for ($i = $year-3; $i < ($year+5);$i++){
			$option_year[] = JHTML::_('select.option',$i,$i);
		}
		$this->search_year = JHTML::_('select.genericlist',$option_year,'year','class="regpro_calendar_years" '.$javascript,'value','text',$year);
		unset($option_year);	
			
		$this->assignRef('category', $category) ;
		$this->assignRef('config', $config) ;
		$this->assignRef('Itemid', $Itemid) ;
		parent::display($tpl);			
	}	
}