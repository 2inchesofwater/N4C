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
class EventBookingViewEvent extends JView
{
	function display($tpl = null)
	{	    
		$layout = $this->getLayout() ;
		if ($layout == 'form') {
			$this->_displayForm($tpl) ;
			return ;
		}
		$mainframe = & JFactory::getApplication() ;
		$j15 = version_compare(JVERSION, '1.6.0', 'ge') ? false : true ;				
		$document = & JFactory::getDocument() ;
		$db = & JFactory::getDBO();			
		$Itemid = JRequest::getInt('Itemid', 0) ;
		$id = JRequest::getInt('event_id', 0) ;
		if (!$id) {
			//Try to get the document id from menu item
			$menus = & JSite::getMenu();
			$menu = $menus->getActive();
			if (is_object($menu)) {			    
			    if ($j15) {
			        $params = new JParameter($menu->params) ;   
			    } else {
			        $params = new JRegistry() ;
			        $params->loadString($menu->params) ;
			    }				
				$id = (int) $params->get('event_id', 0);
				if ($id) {
					JRequest::setVar('event_id', $id, 'get') ;
				}
			}
		}
		if ($id) {
			EventBookingHelper::checkEventAccess($id);
		}
		$sql = 'SELECT COUNT(*) FROM #__eb_events WHERE id='.$id.' AND published= 1' ;
		$db->setQuery($sql) ;
		$totalEvent = $db->loadResult();
		if (!$totalEvent) {
			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('EB_INVALID_EVENT'));			
		} 			
		$config = EventBookingHelper::getConfig();				
		$pathway =& $mainframe->getPathway(); 										
		$item = & $this->get('Data');

		
		//Use short description in case user don't enter long description
		if (strlen(trim(strip_tags($item->description))) == 0)
			$item->description = $item->short_description ;
				
		$parents = & $this->get('categories');
				
		if (!$config->fix_breadcrumbs) {
			for ($i = count($parents)-1 ; $i >= 0 ; $i--) {
				$parent = $parents[$i] ;
				if ($parent->total_children)
					$pathUrl = JRoute::_('index.php?option=com_eventbooking&view=categories&category_id='.$parent->id.'&Itemid='.$Itemid);
				else
					$pathUrl = JRoute::_('index.php?option=com_eventbooking&view=category&category_id='.$parent->id.'&Itemid='.$Itemid);
				$pathway->addItem($parent->name, $pathUrl);
			}
			
			$pathway->addItem($item->title);
		}							
		$tmpl = JRequest::getVar('tmpl', '') ;
		$config->process_plugin = 1 ;		
		if ($config->process_plugin) {
		    if ($j15) {
		        $dispatcher = & JDispatcher::getInstance();
    			JPluginHelper::importPlugin('content');
    			$params = new JParameter('');
    			$limitstart = 0 ;			
    			$article = new stdClass ;
    			$article->catid = 0 ; 
    			$article->sectionid = 0;
    			$article->text = $item->description ;
    			$dispatcher->trigger('onPrepareContent', array (& $article, & $params, $limitstart));
    			$item->description = $article->text ;   
		    } else {
		        $item->description = JHtml::_('content.prepare', $item->description);
		    }			 						
		}		
		if ($tmpl == 'component')
			$showTaskBar = false ;
		else 
			$showTaskBar = true ;							
		$user = & JFactory::getUser() ;
		$userId = $user->get('id', 0);		
		if ($item->location_id) {
			$sql = 'SELECT * FROM #__eb_locations WHERE id='.$item->location_id ;
			$db->setQuery($sql) ;
			$location = $db->loadObject();
			$this->assignRef('location', $location) ;	
		} 
		$sql = 'SELECT name FROM #__eb_categories WHERE id='.$item->category_id ;
		$db->setQuery($sql) ;
		$categoryName = $db->loadResult();
		$pageTitle = JText::_('EB_EVENT_PAGE_TITLE');
		$pageTitle = str_replace('[EVENT_TITLE]', $item->title, $pageTitle) ;
		$pageTitle = str_replace('[CATEGORY_NAME]', $categoryName, $pageTitle) ;
		$document->setTitle($pageTitle);	
        //Set meta data for event detail page		
		$document->setMetaData('keywords', $item->title);		 	
		$nullDate = $db->getNullDate();	
		$sql = 'SELECT * FROM #__eb_event_group_prices WHERE event_id='.$item->id.' ORDER BY id';
		$db->setQuery($sql) ;
		$rowGroupRates = $db->loadObjectList();	
		if ($config->event_custom_field) {
			$params = new JParameter($item->custom_fields, JPATH_COMPONENT.DS.'fields.xml') ;
			$params = $params->getParams();			
			$paramData = array() ;
			foreach ($params as $param) {
				$paramData[$param[5]]['title'] = $param[3] ;
				$paramData[$param[5]]['value'] = $param[4] ;
			}						
			$this->assignRef('params', $params) ;
			$this->assignRef('paramData', $paramData) ;			
		}			
		if (strlen(strip_tags($item->description))) {		
			$document->setMetaData('description', strip_tags($item->description));		
		}	
		if ($j15) {
		    $aid = $user->get('aid');
		    $this->assignRef('aid', $aid) ;
		} else {
		    $viewLevels = $user->getAuthorisedViewLevels() ;
		    $this->assignRef('viewLevels', $viewLevels) ;
		}			
		$this->assignRef('item', $item) ;															
		$this->assignRef('Itemid', $Itemid) ;
		$this->assignRef('config', $config) ;
		$this->assignRef('showTaskBar', $showTaskBar) ;					
		$this->assignRef('userId', $userId) ;
		$this->assignRef('nullDate', $nullDate) ;
		$this->assignRef('rowGroupRates', $rowGroupRates) ;					
		parent::display($tpl);										
	}	
	/**
	 * Display form which allows submitting events
	 * 
	 * @param string $tpl
	 */
	function _displayForm($tpl) {		
		$db = & JFactory::getDBO() ;
		$item = & $this->get('Event');		
		if ($item->id) {
			$ret = EventBookingHelper::checkEditEvent($item->id);
		} else {
			$ret = EventBookingHelper::checkAddEvent() ;
		}		
		if (!$ret) {
			$app = & JFactory::getApplication('site');
			$url = JRoute::_('index.php?option=com_eventbooking');
			$app->redirect($url, JText::_('EB_NO_ADDING_EVENT_PERMISSION'));			
		}
		$prices = $this->get('Prices');		
		$config = EventBookingHelper::getConfig() ;
		//Reset some data for recurring event
		if ($item->recurring_type) {
			if ($item->number_days == 0)
				$item->number_days = '' ;
			if ($item->number_weeks == 0)
				$item->number_weeks = '' ;
			if ($item->number_months == 0)
				$item->number_months = '' ;	
			if ($item->recurring_occurrencies == 0) {
				$item->recurring_occurrencies = '' ;
			}					
		}
		$params =  new JParameter($item->params) ;		
		//Get list of location
		$options = array() ;
		$sql = 'SELECT id, name FROM #__eb_locations  WHERE published=1 ORDER BY name';
		$db->setQuery($sql) ;
		$options[] = JHTML::_('select.option', 0, JText::_('Select Location'), 'id', 'name') ;
		$options = array_merge($options, $db->loadObjectList()) ;
		$lists['location_id'] = JHTML::_('select.genericlist', $options, 'location_id', ' class="inputbox" ', 'id', 'name', $item->location_id) ;

		$sql = "SELECT id, parent, parent AS parent_id, name, name AS title FROM #__eb_categories";			
		$db->setQuery($sql);
		$rows = $db->loadObjectList();		
		$children = array();
		if ($rows)
		{
			// first pass - collect children
			foreach ( $rows as $v )
			{
				$pt 	= $v->parent;
				$list 	= @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}
		}					
		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );				
		$options 	= array();		
		foreach ( $list as $listItem ) {
			$options[] = JHTML::_('select.option',  $listItem->id, '&nbsp;&nbsp;&nbsp;'. $listItem->treename );
		}
		$itemCategories = array() ;
		if ($item->id) {
			$sql = 'SELECT category_id FROM #__eb_event_categories WHERE event_id='.$item->id;
			$db->setQuery($sql) ;
			$categories = $db->loadResultArray() ;
			for ($i = 0 , $n = count($categories) ; $i < $n ; $i++) {
				$itemCategories[] = JHTML::_('select.option', $categories[$i], $categories[$i]);
			}	
		}	

		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $lists['category_id'] = JHTML::_('select.genericlist', $options, 'category_id[]', array(
		        'option.text.toHtml' => false ,
		        'option.text' => 'text' ,
		        'option.value' => 'value', 
		        'list.attr' => 'class="inputbox"  size="5" multiple="multiple"',
		        'list.select' => $itemCategories		    		    		    		    		    
		    ));
		} else {
		    $lists['category_id'] =  JHTML::_('select.genericlist', $options, 'category_id[]', ' class="inputbox"  size="5" multiple="multiple" ', 'value', 'text', $itemCategories);   
		}	 						
		$options = array();		
		$options[] = JHTML::_('select.option' , 1 , JText::_('%'));		
		$options[] = JHTML::_('select.option' , 2 , $config->currency_symbol);		
		$lists['discount_type'] = JHTML::_('select.genericlist', $options, 'discount_type', '' , 'value', 'text', $item->discount_type);						
		$lists['early_bird_discount_type'] = JHTML::_('select.genericlist', $options, 'early_bird_discount_type', '' , 'value', 'text', $item->early_bird_discount_type);					
		$options = array() ;
		$options[] = JHTML::_('select.option', 0, JText::_('EB_INDIVIDUAL_GROUP')) ;
		$options[] = JHTML::_('select.option', 1, JText::_('EB_INDIVIDUAL_ONLY')) ;
		$options[] = JHTML::_('select.option', 2, JText::_('EB_GROUP_ONLY')) ;
		$options[] = JHTML::_('select.option', 3, JText::_('EB_DISABLE_REGISTRATION')) ;
		$lists['registration_type'] = JHTML::_('select.genericlist', $options, 'registration_type', ' class="inputbox" ', 'value', 'text', $item->registration_type);
			
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $lists['access'] = JHtml::_('access.level', 'access', $item->access, 'class="inputbox"', false) ;
		    $lists['registration_access'] = JHtml::_('access.level', 'registration_access', $item->registration_access, 'class="inputbox"', false) ;		       
		} else {
		    $sql = 'SELECT id AS value, name AS text'
    		. ' FROM #__groups'
    		. ' ORDER BY id'
    		;
    		$db->setQuery($sql) ;
    		$groups = $db->loadObjectList();		
    		$lists['access'] = JHTML::_('select.genericlist',   $groups, 'access', 'class="inputbox" ', 'value', 'text', $item->access) ;
    		$lists['registration_access'] = JHTML::_('select.genericlist',   $groups, 'registration_access', 'class="inputbox" ', 'value', 'text', $item->registration_access) ;
		}
					
		$lists['enable_cancel_registration'] = JHTML::_('select.booleanlist', 'enable_cancel_registration', ' class="inputbox" ', $item->enable_cancel_registration);
		$lists['enable_auto_reminder'] = JHTML::_('select.booleanlist', 'enable_auto_reminder', ' class="inputbox" ', $item->enable_auto_reminder);
							
		$lists['published'] = JHTML::_('select.booleanlist', 'published', ' class="inputbox" ', $item->published);		
		if ($item->event_date != $db->getNullDate()) {
			$selectedHour = date('G', strtotime($item->event_date)) ;
			$selectedMinute = date('i', strtotime($item->event_date)) ;							
		} else {
			$selectedHour = 0 ;
			$selectedMinute = 0 ;			
		}
		$lists['event_date_hour'] = JHTML::_('select.integerlist', 0, 23, 1, 'event_date_hour', ' class="inputbox" ', $selectedHour) ;
		$lists['event_date_minute'] = JHTML::_('select.integerlist', 0, 60, 5, 'event_date_minute', ' class="inputbox" ', $selectedMinute, '%02d') ;			
		if ($item->event_end_date != $db->getNullDate()) {
			$selectedHour = date('G', strtotime($item->event_end_date)) ;
			$selectedMinute = date('i', strtotime($item->event_end_date));									
		} else {
			$selectedHour = 0 ;
			$selectedMinute = 0 ;			
		}
		$lists['event_end_date_hour'] = JHTML::_('select.integerlist', 0, 23, 1, 'event_end_date_hour', ' class="inputbox" ', $selectedHour) ;
		$lists['event_end_date_minute'] = JHTML::_('select.integerlist', 0, 60, 5, 'event_end_date_minute', ' class="inputbox" ', $selectedMinute, '%02d') ;			
		//Terms and condition article
		$sql = 'SELECT id, title FROM #__content WHERE sectionid=0 AND catid=0 ';
		$db->setQuery($sql) ;
		$rows = $db->loadObjectList();
		$options = array() ;
		$options[] = JHTML::_('select.option', 0 , JText::_('Select article'), 'id', 'title') ;
		$options = array_merge($options, $rows) ;
		$lists['article_id'] = JHTML::_('select.genericlist', $options, 'article_id', 'class="inputbox"', 'id', 'title', $item->article_id);
		//Field setting				
		$lists['s_lastname'] = JHTML::_('select.booleanlist', 's_lastname', '', $params->get('s_lastname', $config->s_lastname));
		$lists['r_lastname'] = JHTML::_('select.booleanlist', 'r_lastname', '', $params->get('r_lastname', $config->r_lastname));		
		$lists['s_organization'] = JHTML::_('select.booleanlist', 's_organization', '', $params->get('s_organization', $config->s_organization));
		$lists['r_organization'] = JHTML::_('select.booleanlist', 'r_organization', '', $params->get('r_organization', $config->r_organization));
		$lists['s_address'] = JHTML::_('select.booleanlist', 's_address', '', $params->get('s_address', $config->s_address));
		$lists['r_address'] = JHTML::_('select.booleanlist', 'r_address', '', $params->get('r_address', $config->r_address));		
		$lists['s_address2'] = JHTML::_('select.booleanlist', 's_address2', '', $params->get('s_address2', $config->s_address2));
		$lists['r_address2'] = JHTML::_('select.booleanlist', 'r_address2', '', $params->get('r_address2', $config->r_address2));		
		$lists['s_city'] = JHTML::_('select.booleanlist', 's_city', '', $params->get('s_city', $config->s_city));
		$lists['r_city'] = JHTML::_('select.booleanlist', 'r_city', '', $params->get('r_city', $config->r_city));
		$lists['s_state'] = JHTML::_('select.booleanlist', 's_state', '', $params->get('s_state', $config->s_state));
		$lists['r_state'] = JHTML::_('select.booleanlist', 'r_state', '', $params->get('r_state', $config->r_state));
		$lists['s_zip'] = JHTML::_('select.booleanlist', 's_zip', '', $params->get('s_zip', $config->s_zip));
		$lists['r_zip'] = JHTML::_('select.booleanlist', 'r_zip', '', $params->get('r_zip', $config->r_zip));
		$lists['s_country'] = JHTML::_('select.booleanlist', 's_country', '', $params->get('s_country', $config->s_country));
		$lists['r_country'] = JHTML::_('select.booleanlist', 'r_country', '', $params->get('r_country', $config->r_country));
		$lists['s_phone'] = JHTML::_('select.booleanlist', 's_phone', '', $params->get('s_phone', $config->s_phone));
		$lists['r_phone'] = JHTML::_('select.booleanlist', 'r_phone', '', $params->get('r_phone', $config->r_phone));
		$lists['s_fax'] = JHTML::_('select.booleanlist', 's_fax', '', $params->get('s_fax', $config->s_fax));
		$lists['r_fax'] = JHTML::_('select.booleanlist', 'r_fax', '', $params->get('r_fax', $config->r_fax));
		$lists['s_comment'] = JHTML::_('select.booleanlist', 's_comment', '', $params->get('s_comment', $config->s_comment));
		$lists['r_comment'] = JHTML::_('select.booleanlist', 'r_comment', '', $params->get('r_comment', $config->r_comment));
		
		$lists['gs_lastname'] = JHTML::_('select.booleanlist', 'gs_lastname', '', $params->get('gs_lastname', $config->gs_lastname));
		$lists['gr_lastname'] = JHTML::_('select.booleanlist', 'gr_lastname', '', $params->get('gr_lastname', $config->gr_lastname));		
		$lists['gs_organization'] = JHTML::_('select.booleanlist', 'gs_organization', '', $params->get('gs_organization', $config->gs_organization));
		$lists['gr_organization'] = JHTML::_('select.booleanlist', 'gr_organization', '', $params->get('gr_organization', $config->gr_organization));
		$lists['gs_address'] = JHTML::_('select.booleanlist', 'gs_address', '', $params->get('gs_address', $config->gs_address));
		$lists['gr_address'] = JHTML::_('select.booleanlist', 'gr_address', '', $params->get('gr_address', $config->gr_address));		
		$lists['gs_address2'] = JHTML::_('select.booleanlist', 'gs_address2', '', $params->get('gs_address2', $config->gs_address2));
		$lists['gr_address2'] = JHTML::_('select.booleanlist', 'gr_address2', '', $params->get('gr_address2', $config->gr_address2));		
		$lists['gs_city'] = JHTML::_('select.booleanlist', 'gs_city', '', $params->get('gs_city', $config->gs_city));
		$lists['gr_city'] = JHTML::_('select.booleanlist', 'gr_city', '', $params->get('gr_city', $config->gr_city));
		$lists['gs_state'] = JHTML::_('select.booleanlist', 'gs_state', '', $params->get('gs_state', $config->gs_state));
		$lists['gr_state'] = JHTML::_('select.booleanlist', 'gr_state', '', $params->get('gr_state', $config->gr_state));
		$lists['gs_zip'] = JHTML::_('select.booleanlist', 'gs_zip', '', $params->get('gs_zip', $config->gs_zip));
		$lists['gr_zip'] = JHTML::_('select.booleanlist', 'gr_zip', '', $params->get('gr_zip', $config->gr_zip));
		$lists['gs_country'] = JHTML::_('select.booleanlist', 'gs_country', '', $params->get('gs_country', $config->gs_country));
		$lists['gr_country'] = JHTML::_('select.booleanlist', 'gr_country', '', $params->get('gr_country', $config->gr_country));
		$lists['gs_phone'] = JHTML::_('select.booleanlist', 'gs_phone', '', $params->get('gs_phone', $config->gs_phone));
		$lists['gr_phone'] = JHTML::_('select.booleanlist', 'gr_phone', '', $params->get('gr_phone', $config->gr_phone));
		$lists['gs_fax'] = JHTML::_('select.booleanlist', 'gs_fax', '', $params->get('gs_fax', $config->gs_fax));
		$lists['gr_fax'] = JHTML::_('select.booleanlist', 'gr_fax', '', $params->get('gr_fax', $config->gr_fax));
		$lists['gs_email'] = JHTML::_('select.booleanlist', 'gs_email', '', $params->get('gs_email', @$config->gs_email));
		$lists['gr_email'] = JHTML::_('select.booleanlist', 'gr_email', '', $params->get('gr_email', @$config->gr_email));
		$lists['gs_comment'] = JHTML::_('select.booleanlist', 'gs_comment', '', $params->get('gs_comment', $config->gs_comment));
		$lists['gr_comment'] = JHTML::_('select.booleanlist', 'gr_comment', '', $params->get('gr_comment', $config->gr_comment));										
		$nullDate = $db->getNullDate();
						
		//Custom field handles
		if ($config->event_custom_field) {
			$fields = new JParameter( $item->custom_fields, JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'fields.xml');
			$this->assignRef('fields', $fields) ;			
		}					
		$Itemid = JRequest::getInt('Itemid');	
		jimport('joomla.html.pane');		
		$tabConfig = array('useCookies' => 1);
		$tabs = JPane::getInstance('Tabs', $tabConfig);										
		$this->assignRef('item', $item);		
		$this->assignRef('prices', $prices);					
		$this->assignRef('lists', $lists) ;
		$this->assignRef('tabs', $tabs) ;
		$this->assignRef('nullDate', $nullDate) ;
		$this->assignRef('config', $config) ;
		$this->assignRef('Itemid', $Itemid) ;
		parent::display($tpl);			
	}
}