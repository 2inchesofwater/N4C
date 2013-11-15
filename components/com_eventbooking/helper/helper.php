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

class EventBookingHelper {
	/**
	 * Get configuration data and store in config object
	 *
	 * @return object
	 */
	function getConfig($nl2br = false) {
		static $config ;
		if (!$config) {
			$db = & JFactory::getDBO();
			$config = new stdClass ;
			$sql = 'SELECT * FROM #__eb_configs';
			$db->setQuery($sql);
			$rows = $db->loadObjectList();
			for ($i = 0 , $n = count($rows); $i < $n; $i++) {
				$row = $rows[$i];
				$key = $row->config_key;
				$value = stripslashes($row->config_value);
				if ($nl2br)
					$value = nl2br($value); 
				$config->$key = $value;	
			}
		}		
		return $config;
	}
			
	function getURL() {
		static $url ;
		if (!$url) {			
		    $ssl = EventBookingHelper::getConfigValue('use_https');
		    if (version_compare(JVERSION, '1.6.0', 'ge')) {
		        $url = JURI::base() ;
		        if ($ssl)
		            $url = str_replace('http://', 'https://', $url) ;		            		          
		    } else {		        
		        $uri = & JURI::getInstance();    			
    			if ($ssl && !$uri->isSSL()) {
    				$uri->setScheme('https') ;				
    			}	
    			$base = $uri->toString( array('scheme', 'host', 'port'));
    			if (strpos(php_sapi_name(), 'cgi') !== false && !empty($_SERVER['REQUEST_URI'])) {
    					//Apache CGI
    				$path =  rtrim(dirname(str_replace(array('"', '<', '>', "'"), '', $_SERVER["PHP_SELF"])), '/\\');
    			} else {
    				//Others
    				$path =  rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    			}			
    			$url = $base.$path.'/';
		    } 			
		}		
		return $url ;	
	}
	
	/**
	 * Get specify config value
	 *
	 * @param string $key
	 */
	function getConfigValue($key) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT config_value FROM #__eb_configs WHERE config_key="'.$key.'"';
		$db->setQuery($sql) ;
		return $db->loadResult();
	}	
	/**
	 * Get Itemid of Joom Donation
	 *
	 * @return int
	 */
	function getItemid() {
		$db = & JFactory::getDBO();
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $user = & JFactory::getUser() ;
		    $sql = "SELECT id FROM #__menu WHERE link LIKE '%index.php?option=com_eventbooking%' AND published=1 AND `access` IN (".implode(',', $user->getAuthorisedViewLevels()).") ORDER BY `access`";
		} else {
		    $user = & JFactory::getUser() ;
		    $aid = $user->get('aid');
		    $sql = "SELECT id FROM #__menu WHERE link LIKE '%index.php?option=com_eventbooking%' AND published=1 AND `access` <= $aid ORDER BY `access`";    
		}		
		$db->setQuery($sql) ;
		$itemId = $db->loadResult();		
		if (!$itemId) {
			$Itemid = JRequest::getInt('Itemid');
			if ($Itemid == 1)
				$itemId = 999999 ;
			else 
				$itemId = $Itemid ;	
		}			
		return $itemId ;	
	}
		
	function formatCurrency($amount, $config) {	    
	    $decimals = isset($config->decimals) ?  $config->decimals : 2 ;
        $dec_point = isset($config->dec_point) ? $config->dec_point : '.' ;
        $thousands_sep = isset($config->thousands_sep) ? $config->thousands_sep : ',' ;
        return $config->currency_position ? (number_format($amount, $decimals, $dec_point, $thousands_sep).$config->currency_symbol) : ($config->currency_symbol.number_format($amount, $decimals, $dec_point, $thousands_sep))  ; 	    
	}
	/**
	 * Load language from main component
	 *
	 */
	function loadLanguage() {
		static $loaded ;
		if (!$loaded) {
			$lang = & JFactory::getLanguage() ;
			$tag = $lang->getTag();
			if (!$tag)
				$tag = 'en-GB' ;			
			$lang->load('com_eventbooking', JPATH_ROOT, $tag);
			$loaded = true ;	
		}		
	}	
	/**
	 * Get email content. For [PAYMENT_DETAIL] tag
	 *
	 * @param object $config
	 * @param object $row
	 * @return string
	 */		
	function getEmailContent($config, $row) {
		$Itemid = JRequest::getInt('Itemid');
		jimport( 'joomla.application.component.view') ;
		$db = & JFactory::getDBO() ;			
		$viewConfig['name'] = 'form' ;
		$viewConfig['base_path'] = JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'emailtemplates' ;
		$viewConfig['template_path'] = JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'emailtemplates' ;		
		//We will need to check
		if ($config->multiple_booking) {
			$viewConfig['layout'] = 'cart' ;			
		} else {
			//Check to see whether this registration record
			$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE group_id='.$row->id;
			$db->setQuery($sql) ;
			$total = $db->loadResult();			
			if ($total)			
				$viewConfig['layout'] = 'group_detail' ;
			else 
				$viewConfig['layout'] = 'individual_detail' ;
		}					
		$view =  new JView($viewConfig) ;				
		if ($config->multiple_booking) {
			$view->assignRef('config', $config) ;
			$view->assignRef('row', $row) ;
			$view->assignRef('Itemid', $Itemid) ;			
			$sql = 'SELECT a.*, b.event_date, b.title FROM #__eb_registrants AS a INNER JOIN #__eb_events AS b ON a.event_id=b.id WHERE a.id='.$row->id.' OR a.cart_id='.$row->id;
			$db->setQuery($sql) ;
			$rows = $db->loadObjectList() ;
			$sql = 'SELECT SUM(total_amount) FROM #__eb_registrants WHERE id='.$row->id.' OR cart_id='.$row->id;
			$db->setQuery($sql) ;
			$totalAmount = $db->loadResult();
			
			$sql = 'SELECT SUM(tax_amount) FROM #__eb_registrants WHERE id='.$row->id.' OR cart_id='.$row->id;
			$db->setQuery($sql) ;
			$taxAmount = $db->loadResult() ;			
			
			$sql = 'SELECT SUM(discount_amount) FROM #__eb_registrants WHERE id='.$row->id.' OR cart_id='.$row->id;
			$db->setQuery($sql) ;
			$discountAmount = $db->loadResult();			
			$amount = $totalAmount - $discountAmount ;
						
			//Added support for custom field feature
			$jcFields = new JCFields($row->id, false, 4) ;
			$view->assignRef('jcFields', $jcFields) ;
						
			$view->assignRef('discountAmount', $discountAmount) ;			
			$view->assignRef('totalAmount', $totalAmount) ;
			$view->assignRef('items', $rows) ; 
			$view->assignRef('amount', $amount) ;
			$view->assignRef('taxAmount', $taxAmount) ;
		} else {
			$sql = 'SELECT event_date, title, params FROM #__eb_events WHERE id='.$row->event_id ;
			$db->setQuery($sql) ;
			$rowEvent = $db->loadObject();				
			$sql = 'SELECT a.* FROM #__eb_locations AS a '
				.' INNER JOIN #__eb_events AS b ' 
				.' ON a.id = b.location_id '
				.' WHERE b.id =' .$row->event_id ;
			;
			$db->setQuery($sql) ;
			$rowLocation = $db->loadObject() ;
			//Override config			
			$params = new JParameter($rowEvent->params) ;
			$keys = array('s_lastname', 'r_lastname', 's_organization', 'r_organization', 's_address', 'r_address', 's_address2', 'r_address2', 's_city', 'r_city', 's_state', 'r_state', 's_zip', 'r_zip', 's_country', 'r_country', 's_phone', 'r_phone', 's_fax', 'r_fax', 's_comment', 'r_comment');				
			foreach ($keys as $key) {
				$config->$key = $params->get($key, 0) ;
			}		
			$keys = array('gr_lastname', 'gr_lastname', 'gs_organization', 'gr_organization', 'gs_address', 'gr_address', 'gs_address2', 'gr_address2', 'gs_city', 'gr_city', 'gs_state', 'gr_state', 'gs_zip', 'gr_zip', 'gs_country', 'gr_country', 'gs_phone', 'gr_phone', 'gs_fax', 'gr_fax', 'gs_email', 'gr_email', 'gs_comment', 'gr_comment');
			foreach ($keys as $key) {
				$config->$key = $params->get($key, 0) ;
			}
							
			$view->assignRef('rowEvent', $rowEvent) ;
			$view->assign('config', $config) ;
			$view->assignRef('row', $row) ;
			$view->assignRef('rowLocation', $rowLocation) ;
			if (EventBookingHelper::isGroupRegistration($row->id)) {
				$sql = 'SELECT * FROM #__eb_registrants WHERE group_id='.$row->id ;
				$db->setQuery($sql) ;
				$rowMembers = $db->loadObjectList();
				$view->assignRef('rowMembers', $rowMembers) ;							
			} else {
				$jcFields = new JCFields($row->event_id, false, 0) ;
				$view->assignRef('jcFields', $jcFields) ;	 
			}			
		}									
		ob_start();		
		$view->display() ;	
		$text = ob_get_contents() ;
		ob_end_clean();
		return $text ;			
	}		
	/**
	 * Build category dropdown
	 *
	 * @param int $selected
	 * @param string $name
	 * @param Boolean $onChange
	 * @return string
	 */
	function buildCategoryDropdown($selected, $name="parent", $onChange=true) {
		$db = & JFactory::getDBO();
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
		$options[] 	= JHTML::_('select.option',  '0', JText::_( 'Top' ) );
		foreach ( $list as $item ) {
			$options[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'. $item->treename );
		}
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    if ($onChange)
		        return JHtml::_('select.genericlist', $options, $name, array(
		                'option.text.toHtml' => false ,
		                'option.text' => 'text',
		                'option.value' => 'value',
		                'list.attr' => 'class="inputbox" onchange="submit();"',
		                'list.select' => $selected    		        		       
		        ));			    
		    else
			    return JHtml::_('select.genericlist', $options, $name, array(
		                'option.text.toHtml' => false ,
		                'option.text' => 'text',
		                'option.value' => 'value',
		                'list.attr' => 'class="inputbox" ',
		                'list.select' => $selected    		        		       
		        ));
		} else {
		    if ($onChange)
			    return JHTML::_('select.genericlist',   $options, $name, 'class="inputbox" onchange="submit();" ', 'value', 'text', $selected );
		    else
			    return JHTML::_('select.genericlist',   $options, $name, 'class="inputbox" ', 'value', 'text', $selected );    
		}		
	}	
	/**
	 * Parent category select list
	 *
	 * @param object $row
	 * @return void
	 */
	function parentCategories($row) {
		$db =& JFactory::getDBO();
		$sql = "SELECT id, parent, parent AS parent_id, name, name AS title FROM #__eb_categories";
		if ($row->id)
			$sql .= ' WHERE id != '.$row->id;				
		if (!$row->parent) {
			$row->parent = 0;
		}		
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
		$options[] 	= JHTML::_('select.option',  '0', JText::_( 'Top' ) );
		foreach ( $list as $item ) {
			$options[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'. $item->treename );
		}
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    return JHtml::_('select.genericlist', $options, 'parent', array(
		           'option.text.toHtml' => false , 
		           'option.text' => 'text',
		           'option.value' => 'value',
		           'list.attr' => ' class="inputbox" ' ,
		           'list.select' => $row->parent	                  		    		    
		    ));    
		} else {
		    return JHTML::_('select.genericlist',   $options, 'parent', 'class="inputbox"', 'value', 'text', $row->parent );
		}		
	}
	
	
	function attachmentList($attachment, $config) {
	    jimport('joomla.filesystem.folder') ;
	    $path = JPATH_ROOT.DS.'media'.DS.'com_eventbooking' ;				
		$files = JFolder::files($path, strlen(trim($config->attachment_file_types)) ? $config->attachment_file_types : 'bmp|gif|jpg|png|swf|zip|doc|pdf|xls') ;		
		$options = array();		
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_ATTACHMENT'));
		for ($i = 0 , $n = count($files) ; $i < $n; $i++) {
			$file = $files[$i] ;
			$options[] = JHTML::_('select.option', $file, $file) ;
		}
		return JHTML::_('select.genericlist',   $options, 'attachment', 'class="inputbox"', 'value', 'text', $attachment);
	}
	
	/**
	 * Get total document of a category
	 *
	 * @param int $categoryId
	 */
	function getTotalEvent($categoryId, $includeChildren = true) {
	    $user = & JFactory::getUser() ;
		$hidePastEvents = EventBookingHelper::getConfigValue('hide_past_events') ;
		$db = & JFactory::getDBO();
		$arrCats = array();
		$cats = array();
		$arrCats[] =  $categoryId;
		$cats[] = $categoryId;
		if ($includeChildren) {
			while (count($arrCats)) {
				$catId = array_pop($arrCats);
				//Get list of children category
				$sql  = 'SELECT id FROM #__eb_categories WHERE parent='.$catId.' AND published=1';
				$db->setQuery($sql);				
				$rows = $db->loadObjectList();
				for ($i = 0 , $n = count($rows); $i < $n; $i++) {
					$row = $rows[$i];
					$arrCats[] = $row->id;
					$cats[] = $row->id;
				}
			}	
		}
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    if ($hidePastEvents) 
			    $sql = 'SELECT COUNT(a.id) FROM #__eb_events AS a INNER JOIN #__eb_event_categories AS b ON a.id = b.event_id WHERE b.category_id IN('.implode(',', $cats).') AND published = 1 AND `access` IN ('.implode(',', $user->getAuthorisedViewLevels()).') AND event_date >= NOW() ';
		    else 
			    $sql = 'SELECT COUNT(a.id) FROM #__eb_events AS a INNER JOIN #__eb_event_categories AS b ON a.id = b.event_id WHERE b.category_id IN('.implode(',', $cats).') AND `access` IN ('.implode(',', $user->getAuthorisedViewLevels()).') AND published = 1 ';
		} else {
		    if ($hidePastEvents) 
    			$sql = 'SELECT COUNT(a.id) FROM #__eb_events AS a INNER JOIN #__eb_event_categories AS b ON a.id = b.event_id WHERE b.category_id IN('.implode(',', $cats).') AND published = 1 AND event_date >= NOW() ';
    		else 
    			$sql = 'SELECT COUNT(a.id) FROM #__eb_events AS a INNER JOIN #__eb_event_categories AS b ON a.id = b.event_id WHERE b.category_id IN('.implode(',', $cats).') AND published = 1 ';    
		}
			
		$db->setQuery($sql);		
		return  (int)$db->loadResult();											
	}
	/**
	 * Check to see whether this event still accept registration
	 *
	 * @param int $eventId
	 * @return Boolean
	 */
	function acceptRegistration($eventId) {
		$db = & JFactory::getDBO() ;
		$user = & JFactory::getUser() ;
		$gid = $user->get('aid');		
		if (!$eventId)
			return false ;		
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId.' AND published=1 ' ;		
		$db->setQuery($sql) ;
		$row = $db->loadObject();
		if (!$row)
			return false ;
		if ($row->registration_type == 3)
			return false ;
	    if (version_compare(JVERSION, '1.6.0', 'ge')) {
    		if (!in_array($row->registration_access, $user->getAuthorisedViewLevels())) {
    			return false ;
    		}
		} else {
    		if ($row->registration_access > $gid) {
    			return false ;
    		}    
		}		
		if ($row->cut_off_date == $db->getNullDate()) {
			$sql = 'SELECT DATEDIFF(NOW(), event_date) AS number_days FROM #__eb_events WHERE id='.$eventId ;				
		} else {
			$sql = 'SELECT DATEDIFF(NOW(), cut_off_date) AS number_days FROM #__eb_events WHERE id='.$eventId ;
		}			
		$db->setQuery($sql) ;
		$numberDays = $db->loadResult();
		if ($numberDays > 0) {
			return false ;
		}
		if ($row->event_capacity) {
			//Get total registrants for this event
			$sql = 'SELECT SUM(number_registrants) AS total_registrants FROM #__eb_registrants WHERE event_id='.$eventId.' AND group_id=0 AND (published=1 OR (payment_method LIKE "os_offline%" AND published != 2))' ; 
			$db->setQuery($sql) ;
			$numberRegistrants = (int)$db->loadResult();
			if ($numberRegistrants >= $row->event_capacity)
				return false ;	
		}		
		//Check to see whether the current user has registered for the event
		$preventDuplicateRegistration = EventBookingHelper::getConfigValue('prevent_duplicate_registration') ;
		if ($preventDuplicateRegistration && $user->get('id')) {
			$sql = 'SELECT COUNT(id) FROM #__eb_registrants WHERE event_id='.$eventId.' AND user_id='.$user->get('id').' AND (published=1 OR (payment_method LIKE "os_offline%" AND published != 2))';
			$db->setQuery($sql) ;
			$total = $db->loadResult();
			if ($total) {
				return false ;	
			}	
		}		
		return true ;	
	}
	/**
	 * Get total registrants
	 *
	 */
	function getTotalRegistrants($eventId) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT SUM(number_registrants) AS total_registrants FROM #__eb_registrants WHERE event_id='.$eventId.' AND group_id=0 AND (published=1 OR (payment_method LIKE "os_offline%" AND published != 2))' ; 
		$db->setQuery($sql) ;
		$numberRegistrants = (int)$db->loadResult();
		return $numberRegistrants ;
	}
	/**
	 * Get registration rate for group registration
	 *
	 * @param int $eventId
	 * @param int $numberRegistrants
	 * @return 
	 */
	function getRegistrationRate($eventId, $numberRegistrants) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT price FROM #__eb_event_group_prices WHERE event_id='.$eventId.' AND registrant_number <= '.$numberRegistrants.' ORDER BY registrant_number DESC LIMIT 1';
		$db->setQuery($sql) ;
		$rate = $db->loadResult();				
		if (!$rate) {
			$sql = 'SELECT individual_price FROM #__eb_events WHERE id='.$eventId;
			$db->setQuery($sql) ;
			$rate = $db->loadResult();
		}				
		return $rate ;
	}	
	/**
	 * Check to see whether the ideal payment plugin installed and activated
	 * @return boolean	 
	 */
	function idealEnabled() {
		$db = & JFactory::getDBO();
		$sql = 'SELECT COUNT(id) FROM #__eb_payment_plugins WHERE name="os_ideal" AND published=1';
		$db->setQuery($sql) ;
		$total = $db->loadResult() ;
		if ($total) {
			require_once JPATH_COMPONENT.DS.'payments'.DS.'ideal'.DS.'ideal.class.php';
			return true ;
		} else {
			return false ;	
		}			
	}
	/**	 
	 * Get list of banks for ideal payment plugin
	 * @return array
	 */
	function getBankLists() {		
		$idealPlugin = os_payments::loadPaymentMethod('os_ideal');
		$params = new JParameter($idealPlugin->params) ;
		$partnerId = $params->get('partner_id');
		$ideal = new iDEAL_Payment($partnerId) ;
		$bankLists = $ideal->getBanks();
		return $bankLists ;
	}	
	/**
	 * Helper function for sending emails to registrants and administrator
	 *
	 * @param RegistrantEventBooking $row
	 * @param object $config
	 */		
	function sendEmails($row, $config) {		
		$jconfig = new JConfig();				
		$db = & JFactory::getDBO();			
		if ($config->from_name)
			$fromName = $config->from_name ;
		else 
			$fromName = $jconfig->fromname ;
		if ($config->from_email)
			$fromEmail = $config->from_email ;
		else			
			$fromEmail =  $jconfig->mailfrom ;				
		$sql = "SELECT * FROM #__eb_events WHERE id=".$row->event_id ;
		$db->setQuery($sql) ;
		$event = $db->loadObject();
		$params = new JParameter($event->params) ;
		$keys = array('s_lastname', 's_organization', 's_address', 's_address2', 's_city', 's_state', 's_zip', 's_country', 's_phone', 's_fax', 's_comment');
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}				
		//Need to over-ridde some config options				
		$emailContent = EventBookingHelper::getEmailContent($config, $row);
		if ($config->multiple_booking) {
			$sql = 'SELECT event_id FROM #__eb_registrants WHERE id='.$row->id.' OR cart_id='.$row->id.' ORDER BY id' ;
			$db->setQuery($sql) ;
			$eventIds = $db->loadResultArray();
			$sql = 'SELECT title FROM #__eb_events WHERE id IN ('.implode(',', $eventIds).') ORDER BY FIND_IN_SET(id, "'.implode(',', $eventIds).'")';
			$db->setQuery($sql) ;
			$eventTitles = $db->loadResultArray();
			$eventTitle = implode(', ', $eventTitles) ;						
		} else {
			$sql = 'SELECT title FROM #__eb_events WHERE id='.$row->event_id ;
			$db->setQuery($sql) ;
			$eventTitle = $db->loadResult();	
		}			
		$replaces = array() ;		
		$replaces['event_title'] = $eventTitle ;			
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $replaces['event_date'] = JHTML::_('date', $event->event_date, $config->event_date_format, null);
		} else {
		    $replaces['event_date'] = JHTML::_('date', $event->event_date, $config->event_date_format, 0);
		}				
		$replaces['first_name'] = $row->first_name ;
		$replaces['last_name'] = $row->last_name ;
		$replaces['organization'] = $row->organization ;
		$replaces['address'] = $row->address ;
		$replaces['address2'] = $row->address ;
		$replaces['city'] = $row->city ;
		$replaces['state'] = $row->state ;
		$replaces['zip'] = $row->zip ;
		$replaces['country'] = $row->country ;
		$replaces['phone'] = $row->phone ;
		$replaces['fax'] = $row->phone ;
		$replaces['email'] = $row->email ;
		$replaces['transaction_id'] = $row->transaction_id ;
		$replaces['comment'] = $row->comment ;
		$replaces['amount'] = number_format($row->amount, 2) ;
		//Add support for location tag
		$sql = 'SELECT a.* FROM #__eb_locations AS a '
				.' INNER JOIN #__eb_events AS b ' 
				.' ON a.id = b.location_id '
				.' WHERE b.id =' .$row->event_id ;
			;
		$db->setQuery($sql) ;
		$rowLocation = $db->loadObject() ;
		if ($rowLocation) {
		    $replaces['location'] = $rowLocation->name.' ('.$rowLocation->address.', '.$rowLocation->city.','. $rowLocation->state.', '.$rowLocation->zip.', '.$rowLocation->country.')' ;
		} else {
		    $replaces['location'] = '' ;		    
		}		
		//Override config messages
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$row->event_id ;
		$db->setQuery($sql) ;
		$rowEvent = $db->loadObject();
		if ($rowEvent) {			
			if (strlen(trim(strip_tags($rowEvent->user_email_body)))) {
				$config->user_email_body = $rowEvent->user_email_body ;
			}
			if (strlen(trim(strip_tags($rowEvent->user_email_body_offline)))) {
				$config->user_email_body_offline = $rowEvent->user_email_body_offline ;
			}			
		}		
		//Notification email send to user
		$subject = $config->user_email_subject;
		if (strpos($row->payment_method, 'os_offline') !== false) {
			$body = $config->user_email_body_offline ;
		} else {
			$body = $config->user_email_body ;
		}				
		$subject = str_replace('[EVENT_TITLE]', $eventTitle, $subject) ;
		$body = str_replace('[REGISTRATION_DETAIL]', $emailContent, $body) ;
		foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$body = str_replace("[$key]", $value, $body) ;
		}																				
	    if ($event->attachment) {
            JUtility::sendMail($fromEmail, $fromName, $row->email, $subject, $body, 1, null, null, JPATH_ROOT.DS.'media'.DS.'com_eventbooking'.DS.$event->attachment);
        } else {
            JUtility::sendMail($fromEmail, $fromName, $row->email, $subject, $body, 1);
        }				
		//Send emails to notification emails
		if (strlen(trim($event->notification_emails)) > 0)
			$config->notification_emails = $event->notification_emails ;
		if ($config->notification_emails == '')	
			$notificationEmails = $fromEmail;
		else 
			$notificationEmails = $config->notification_emails;
		$notificationEmails = str_replace(' ', '', $notificationEmails);
		$emails = explode(',', $notificationEmails);				
		$subject = $config->admin_email_subject ;
		$subject = str_replace('[EVENT_TITLE]', $eventTitle, $subject) ;
		$body = $config->admin_email_body ;		
		$body = str_replace('[REGISTRATION_DETAIL]', $emailContent, $body);
		foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$body = str_replace("[$key]", $value, $body) ;
		}
		for ($i = 0, $n  = count($emails); $i < $n ; $i++) {
			$email = $emails[$i];
			JUtility::sendMail($fromEmail, $fromName, $email, $subject, $body, 1);					
		}												
	}				
	/**
	 * Send email when users fill-in waitinglist
	 * 
	 * @param  object $row
	 * @param object $config
	 */
	function sendWaitinglistEmail($row, $config) {	        
	    $jconfig = new JConfig();				
		$db = & JFactory::getDBO();			
		if ($config->from_name)
			$fromName = $config->from_name ;
		else 
			$fromName = $jconfig->fromname ;
		if ($config->from_email)
			$fromEmail = $config->from_email ;
		else			
			$fromEmail =  $jconfig->mailfrom ;				
		$sql = "SELECT * FROM #__eb_events WHERE id=".$row->event_id ;
		$db->setQuery($sql) ;
		$event = $db->loadObject();					
		//Supported tags
		$replaces = array() ;		
		$replaces['event_title'] = $event->title ;				
		$replaces['first_name'] = $row->first_name ;
		$replaces['last_name'] = $row->last_name ;
		$replaces['organization'] = $row->organization ;
		$replaces['address'] = $row->address ;
		$replaces['address2'] = $row->address ;
		$replaces['city'] = $row->city ;
		$replaces['state'] = $row->state ;
		$replaces['zip'] = $row->zip ;
		$replaces['country'] = $row->country ;
		$replaces['phone'] = $row->phone ;
		$replaces['fax'] = $row->phone ;
		$replaces['email'] = $row->email ;
		$replaces['comment'] = $row->comment ;
	    $replaces['number_registrants'] = $row->number_registrants ;

	    
		//Notification email send to user
		$subject = $config->watinglist_confirmation_subject ;				
		$body = $config->watinglist_confirmation_body ;			
		$subject = str_replace('[EVENT_TITLE]', $event->title, $subject) ;		
		foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$body = str_replace("[$key]", $value, $body) ;
		}																					    
        JUtility::sendMail($fromEmail, $fromName, $row->email, $subject, $body, 1);        
		//Send emails to notification emails
		if (strlen(trim($event->notification_emails)) > 0)
			$config->notification_emails = $event->notification_emails ;
		if ($config->notification_emails == '')	
			$notificationEmails = $fromEmail;
		else 
			$notificationEmails = $config->notification_emails;
		$notificationEmails = str_replace(' ', '', $notificationEmails);
		$emails = explode(',', $notificationEmails);				
		$subject = $config->watinglist_notification_subject ;
		$subject = str_replace('[EVENT_TITLE]', $event->title, $subject) ;
		$body = $config->watinglist_notification_body ;				
		foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$body = str_replace("[$key]", $value, $body) ;
		}
		for ($i = 0, $n  = count($emails); $i < $n ; $i++) {
			$email = $emails[$i];
			JUtility::sendMail($fromEmail, $fromName, $email, $subject, $body, 1);					
		}				
	}		
	/**
	 * Get country code
	 *
	 * @param string $countryName
	 * @return string
	 */
	function getCountryCode($countryName) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT country_2_code FROM #__eb_countries WHERE LOWER(name)="'.JString::strtolower($countryName).'"';
		$db->setQuery($sql) ;
		$countryCode = $db->loadResult();
		if (!$countryCode)
			$countryCode = 'US' ;
		return $countryCode ;		
	}
	/**
	 * Get all categories of one event
	 * @param int $eventId
	 * @return Array
	 */
	function getCategoriesOfEvent($eventId) {		
		static $categories ;
		if (!isset($categories[$eventId])) {
			$db = & JFactory::getDbo() ;
			$sql = 'SELECT category_id FROM #__eb_event_categories WHERE event_id='.$eventId;
			$db->setQuery($sql);
			$categories[$eventId] = $db->loadResultArray();
		}				
		
		return $categories[$eventId] ;
	}	
	/**
	 * Get title of the given payment method
	 * @param string $methodName
	 */		
	function getPaymentMethodTitle($methodName) {
		static $titles ;
		if (!isset($titles[$methodName])) {
			$sql = 'SELECT title FROM #__eb_payment_plugins WHERE name="'.$methodName.'"';
			$db->setQuery($sql);
			$methodTitle = $db->loadResult();
			if ($methodTitle) {
				$titles[$methodName] = $methodTitle ;
			} else {
				$titles[$methodName] = $methodName ;
			}
		}
		
		return $titles[$methodName] ;	
	}
	/**
	 * Display copy right information
	 *
	 */
	function displayCopyRight() {
		global $eb_version ;
		echo '<div class="copyright" style="text-align:center;margin-top: 5px;"><a href="http://joomdonation.com/index.php?option=com_content&view=article&id=79&Itemid=58" target="_blank"><strong>Event Booking</strong></a> version '.$eb_version.', Copyright (C) 2010-2011 <a href="http://joomdonation.com" target="_blank"><strong>Ossolution Team</strong></a></div>' ;
	}
	/**
	 * Calcuate total discount for the registration
	 * @return decimal
	 */		
	function calcuateDiscount() {
		return 10 ;	
	}	
	/**
	 * Check category access
	 *
	 * @param int $categoryId
	 */
	function checkCategoryAccess($categoryId) {
	    $mainframe = & JFactory::getApplication() ;
	    $Itemid = JRequest::getInt('Itemid') ;		
		$user = & JFactory::getUser() ;
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT `access` FROM #__eb_categories WHERE id='.$categoryId ;
		$db->setQuery($sql) ;
		$access = (int)$db->loadResult();
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
    		if (!in_array($access, $user->getAuthorisedViewLevels())) {
    			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('NOT_AUTHORIZED'));		
    		}
		} else {
    		if ($user->get('aid') < $access) {
    			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('NOT_AUTHORIZED'));		
    		}   
		}		
	}
	/**
	 * Check to see whether the current user can 
	 *
	 * @param int $eventId
	 */	
	function checkEventAccess($eventId) {		
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');		
		$db = & JFactory::getDBO() ;
		$user = & JFactory::getUser() ;
		$sql = 'SELECT `access` FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;
		$access = (int)$db->loadResult();
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
    		if (!in_array($access, $user->getAuthorisedViewLevels())) {
    			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('NOT_AUTHORIZED'));		
    		}   
		} else {
    		if ($user->get('aid') < $access) {
    			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('NOT_AUTHORIZED'));		
    		}
		}		
	}	
	/**
	 * Check to see whether a users to access to registration history
	 * Enter description here
	 */
	function checkAccessHistory() {
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');		
		$user = & JFactory::getUser();
		if (!$user->get('id')) {
			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('NOT_AUTHORIZED'));
		}
	}
	/**
	 * 
	 * Check the access to registrants history from frontend
	 */
	function checkRegistrantsAccess() {
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');		
		$registrantAccessUserIds = EventBookingHelper::getConfigValue('registrant_access_user_ids');
		$user = & JFactory::getUser() ;
		$registrantAccessUserIds = explode(',', $registrantAccessUserIds) ;
		JArrayHelper::toInteger($registrantAccessUserIds) ; 		
		if (!in_array($user->get('id'), $registrantAccessUserIds)) {
			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('NOT_AUTHORIZED'));
		}
	}
	/**
	 * Check to see whether the current users can access View List function
	 */
	function canViewRegistrantList() {			
		$userGroupIds = EventBookingHelper::getConfigValue('view_registrant_list_user_or_group_ids') ;
		if (strlen(trim($userGroupIds)) == 0) {
			return true ;
		}			
		$user = & JFactory::getUser() ;
		$userGroupIds = explode(',', $userGroupIds);
		JArrayHelper::toInteger($userGroupIds) ;
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $groups = $user->getAuthorisedGroups() ;	    
		    if (in_array($user->get('id'), $userGroupIds) || count(array_intersect($groups, $userGroupIds)))								
    			return true ;
    		else
    			return false ;
		} else {
		     if (in_array($user->get('id'), $userGroupIds) || in_array($user->get('gid'), $userGroupIds))				
    			return true ;
    		else
    			return false ;   
		}			
	}
	/**
	 * 
	 * Check to see whether this users has permission to edit registrant
	 */
	function checkEditRegistrant() {		
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');			
		$db = & JFactory::getDBO();
		$cid = Jrequest::getVar('cid', array()) ; 
		$registrantId = (int)$cid[0] ;
		$canAccess = true ;
		if (!$registrantId)
			$canAccess = false ;			
		$registrantAccessUserIds = EventBookingHelper::getConfigValue('registrant_access_user_ids');		
		$user = & JFactory::getUser() ;
		$registrantAccessUserIds = explode(',', $registrantAccessUserIds) ;
		JArrayHelper::toInteger($registrantAccessUserIds) ;
		$sql = 'SELECT user_id, email FROM #__eb_registrants WHERE id='.$registrantId ;
		$db->setQuery($sql) ;
		$rowRegistrant = $db->loadObject();						
		if (in_array($user->get('id'), $registrantAccessUserIds) || ($user->get('id') == $rowRegistrant->user_id) || ($user->get('email') == $rowRegistrant->email)) {
			$canAccess = true ;	
		} else {
			$canAccess = false ;
		}
		if (!$canAccess) {
			$mainframe->redirect('index.php?option=com_eventbooking&Itemid='.$Itemid, JText::_('NOT_AUTHORIZED'));	
		}									
	}	
	/**
	 * Check to see whether this event can be cancelled	 
	 * @param int $eventId
	 */
	function canCancel($eventId) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT COUNT(*) FROM #__eb_events WHERE id='.$eventId.' AND enable_cancel_registration = 1 AND (DATEDIFF(cancel_before_date, NOW()) >=0) ';
		$db->setQuery($sql) ;
		$total = $db->loadResult() ;
		if ($total)		
			return true ;
		else
			return false ;			
	}	
	function canExportRegistrants() {
		$config = EventBookingHelper::getConfig();
		$user = & JFactory::getUser() ;
		$userId = $user->id ;
		$manageRegistrantsUserIds = explode(',', $config->registrant_access_user_ids) ;
		JArrayHelper::toInteger($manageRegistrantsUserIds) ;
		if (!$userId || !in_array($userId, $manageRegistrantsUserIds)) {
			return false ;
		} else {
			return true ;
		}
	}
	/**
	 * Check to see whether the users can cancel registration
	 * 
	 * @param int $eventId
	 */
	function canCancelRegistration($eventId) {
	    $db = & JFactory::getDbo() ;
	    $user = & JFactory::getUser() ;
	    $userId = $user->get('id');
	    if (!$userId)
	        return false ;
	    $sql = 'SELECT id FROM #__eb_registrants WHERE event_id='.$eventId.' AND user_id='.$userId.' AND (published=1 OR (payment_method LIKE "os_offline%" AND published!=2))';
	    $db->setQuery($sql) ;
	    $registrantId = $db->loadResult() ;
	    if (!$registrantId)
	        return false ;
	        
	    $sql = 'SELECT COUNT(*) FROM #__eb_events WHERE id='.$eventId.' AND enable_cancel_registration = 1 AND (DATEDIFF(cancel_before_date, NOW()) >=0) ';
		$db->setQuery($sql) ;
		$total = $db->loadResult() ;

		if (!$total)
		    return false ;
		    		
	    return $registrantId ;        	    
	}
	
	/**
	 * Check to see whether the current user can edit registrant
	 *
	 * @param int $eventId
	 * @return boolean
	 */
	function checkEditEvent($eventId) {
		$user = & JFactory::getUser() ;
		$db = & JFactory::getDBO() ;
		if ($user->get('guest'))
		    return false ;		
		if (!$eventId) 
			return false ;
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql);
		$rowEvent = $db->loadObject() ;
		if (!$rowEvent)
			return false ;
		//User can only edit event created by himself	
		if ($rowEvent->created_by != $user->get('id'))
			return false ;	 	
		return true ;
	}
	
	function isGroupRegistration($id) {
		if (!$id)
			return false ;	
		$db = & JFactory::getDbo() ;
		$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE group_id='.$id;
		$db->setQuery($sql);
		$total = (int)$db->loadResult() ;		
		return $total > 0 ? true : false ;
	}
		
	function updateGroupRegistrationRecord($groupId) {
		$db = & JFactory::getDBO();
		$config = EventBookingHelper::getConfig() ;
		if ($config->collect_member_information) {
			$row = & JTable::getInstance('EventBooking', 'Registrant') ;
			$row->load($groupId);
			if ($row->id) {
				$sql = "UPDATE #__eb_registrants SET published=$row->published, transaction_id='$row->transaction_id', payment_method='$row->payment_method' WHERE group_id=".$row->id ;
				$db->setQuery($sql) ;
				$db->query() ;
			}											
		}
	}	
	/**
	 * Check to see whether the current users can add events from front-end
	 * 
	 */
	function checkAddEvent() {
		$user = & JFactory::getUser() ;
		if (!$user->get('id'))
			return false ;
		$userGroupIds = EventBookingHelper::getConfigValue('add_events_user_or_group_ids') ;			
		$userGroupIds = explode(',', $userGroupIds);
		JArrayHelper::toInteger($userGroupIds) ;
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $groups = $user->getAuthorisedGroups() ;	    
		    if (in_array($user->get('id'), $userGroupIds) || count(array_intersect($groups, $userGroupIds)))								
    			return true ;
    		else
    			return false ;
		} else {
		     if (in_array($user->get('id'), $userGroupIds) || in_array($user->get('gid'), $userGroupIds))				
    			return true ;
    		else
    			return false ;   
		}				
	}
	/**
	 * Create a user account	 
	 * @param array $data
	 * @return int Id of created user
	 */
	function saveRegistration($data) {
		if (version_compare(JVERSION, '1.6.0', 'ge')) {			
			//Need to load com_users language file			
			$lang = & JFactory::getLanguage() ;
			$tag = $lang->getTag();
			if (!$tag)
				$tag = 'en-GB' ;
			$lang->load('com_users', JPATH_ROOT, $tag);						
			$data['name'] = $data['first_name'].' '.$data['last_name'] ;
			$data['password1'] = $data['password2'] = $data['password'] ;
			$data['email1'] = $data['email2'] = $data['email'] ;
			require_once JPATH_ROOT.'/components/com_users/models/registration.php' ;
			$model = new UsersModelRegistration() ;			
			$ret = $model->register($data);			
			$db = & JFactory::getDbo() ;
			//Need to get the user ID based on username
			$sql = 'SELECT id FROM #__users WHERE username="'.$data['username'].'"';
			$db->setQuery($sql) ;						
			return (int) $db->loadResult() ;																					
		} else {
			$user 		= clone(JFactory::getUser());
			$authorize	=& JFactory::getACL();
			$data['password2'] = $data['password'] ;
			$data['name'] = $data['first_name'].' '.$data['last_name'] ;
			// If user registration is not allowed, show 403 not authorized.
			$usersConfig = &JComponentHelper::getParams( 'com_users' );
			if ($usersConfig->get('allowUserRegistration') == '0') {
				JError::raiseError( 403, JText::_( 'Access Forbidden' ));
				return false;
			}
			// Initialize new usertype setting
			$newUsertype = $usersConfig->get( 'new_usertype' );
			if (!$newUsertype) {
				$newUsertype = 'Registered';
			}
			
			// Bind the post array to the user object
			if (!$user->bind( $data, 'usertype' )) {
				JError::raiseError( 500, $user->getError());
			}
			
			// Set some initial user values
			$user->set('id', 0);
			$user->set('usertype', $newUsertype);
			$user->set('gid', $authorize->get_group_id( '', $newUsertype, 'ARO' ));
			
			$date =& JFactory::getDate();
			$user->set('registerDate', $date->toMySQL());
			if ( !$user->save() )
			{
				JError::raiseWarning('', JText::_( $user->getError()));
				return false;
			}
			//Add support for CB integration
			$integration = EventBookingHelper::getConfigValue('cb_integration') ;
			if ($integration == 1) {
				$db = & JFactory::getDBO() ;
				$config = EventBookingHelper::getConfig() ;
				//We need to get all fields from CB
				$sql = ' SHOW FIELDS FROM #__comprofiler ';
				$db->setQuery($sql) ;
				$rows = $db->loadObjectList();
				$fields = array();
				for ($i = 0 , $n = count($rows); $i < $n; $i++) {
					$row = $rows[$i];
					$fields[] = $row->Field;
				}
				$fieldMapping = array() ;
				$rowProfile = new stdClass() ;
				//Get the core field
				$basicFields = array('first_name'=>'m_firstname',
						'last_name' => 'm_lastname',
						'organization' => 'm_organization',
						'address' => 'm_address',
						'address2' => 'm_address2',
						'city' => 'm_city',
						'state' => 'm_state',
						'zip' => 'm_zip',
						'country' => 'm_country',
						'phone' => 'm_phone',
						'fax' => 'm_fax'
				) ;
				foreach ($basicFields as $coreField => $basicField) {
					$field = $config->$basicField ;
					if($field && in_array($field, $fields)) {
						$rowProfile->$field = JRequest::getVar($coreField, 'post', '');
					}
				}
				$userId = $user->get('id');
				$rowProfile->approved = 1 ;
				$rowProfile->confirmed = 1 ;
				$rowProfile->id = $userId ;
				$rowProfile->user_id = $userId ;
				//Insert this user into database
				$db->insertObject('#__comprofiler', $rowProfile, 'id') ;
			}
			return $user->get('id');
		}		
	}		
	/**
	 * Get list of recurring event dates
	 * @param DateTime $startDate
	 * @param DateTime $endDate
	 * @param int $dailyFrequency
	 * @param int $numberOccurencies
	 * @return array
	 */	
	function getDailyRecurringEventDates($startDate, $endDate, $dailyFrequency, $numberOccurencies) {
		$eventDates = array() ;
		$eventDates[] = $startDate ;
		//Convert to unix timestamp for easili maintenance
		$startTime = strtotime($startDate) ;			
		$endTime = strtotime($endDate.' 23:59:59') ;			
		if ($numberOccurencies) {
			$count = 1 ;
			$i = 1 ;
			while ($count < $numberOccurencies) {
				$i++ ;
				$count++ ;
				$nextEventDate = $startTime + ($i-1)*$dailyFrequency*24*3600 ;							
				$eventDates[] = strftime('%Y-%m-%d %H:%M:%S', $nextEventDate) ;				
			}			
		} else {
			$i = 1 ;
			while (true) {
				$i++ ;
				$nextEventDate = $startTime + ($i -1)*24*$dailyFrequency*3600 ;
				if ($nextEventDate <= $endTime) {					 				
					$eventDates[] = strftime('%Y-%m-%d %H:%M:%S', $nextEventDate) ;
				} else {
					break ;
				}	
			}			
		}			
		return $eventDates ;	
	}
	/**
	 * Get weekly recurring event dates
	 * @param DateTime $startDate
	 * @param DateTime $endDate
	 * @param Int $weeklyFrequency
	 * @param int $numberOccurrencies
	 * @param array $weekDays
	 * @return array
	 */
	function getWeeklyRecurringEventDates($startDate,  $endDate, $weeklyFrequency, $numberOccurrencies, $weekDays) {
		$eventDates = array() ;				
		$startTime = strtotime($startDate) ;	
		$originalStartTime = $startTime ;
		$endTime = strtotime($endDate.' 23:59:59') ;
		if ($numberOccurrencies) {
			$count = 0 ;
			$i = 0 ;
			$weekDay =  date('w', $startTime) ;
			$startTime = $startTime - $weekDay*24*3600 ;			
			while ($count < $numberOccurrencies) {				
				$i++ ;
				$startWeekTime = $startTime + ($i -1)*$weeklyFrequency*7*24*3600 ;														 						
				foreach ($weekDays as $weekDay) {
					$nextEventDate = $startWeekTime + $weekDay*24*3600 ;
					if (($nextEventDate >= $originalStartTime) && ($count < $numberOccurrencies)) {
						$eventDates[] = strftime('%Y-%m-%d %H:%M:%S', $nextEventDate) ;
						$count++ ;
					}						
				}
			}						
		} else {
			$weekDay =  date('w', $startTime) ;
			$startTime = $startTime - $weekDay*24*3600 ;
			while ($startTime < $endTime) {
				foreach ($weekDays as $weekDay) {
					$nextEventDate = $startTime + $weekDay*24*3600 ; ;
					if ($nextEventDate < $originalStartTime)
						continue ;					
					if ($nextEventDate <= $endTime) {
						$eventDates[] = strftime('%Y-%m-%d %H:%M:%S', $nextEventDate) ;
					} else {
						break ;
					}					
				}
				$startTime += $weeklyFrequency*7*24*3600 ;				
			}					
		}			
		return $eventDates ;	
	}
	/**
	 * Get list of monthly recurring
	 * @param DateTime $startDate
	 * @param DateTime $endDate
	 * @param int $monthlyFrequency
	 * @param int $numberOccurrencies
	 * @param string $monthDays
	 * @return array
	 */
	function getMonthlyRecurringEventDates($startDate, $endDate, $monthlyFrequency, $numberOccurrencies, $monthDays) {
		$eventDates = array() ;				
		$startTime = strtotime($startDate) ;
		$hour = date('H', $startTime);
		$minute = date('i', $startTime) ;	
		$originalStartTime = $startTime ;
		$endTime = strtotime($endDate.' 23:59:59') ;		
		$monthDays = explode(',', $monthDays) ;
		if ($numberOccurrencies) {
			$count = 0 ;
			$currentMonth = date('m', $startTime) ;
			$currentYear = date('Y', $startTime) ;		
			while($count < $numberOccurrencies) {
				foreach ($monthDays as $day) {
					$nextEventDate = mktime($hour, $minute, 0, $currentMonth, $day, $currentYear); 
					if (($nextEventDate >= $originalStartTime) && ($count < $numberOccurrencies)) {
						$eventDates[] = strftime('%Y-%m-%d %H:%M:%S', $nextEventDate) ;
						$count++ ;
					}
				}
				$currentMonth += $monthlyFrequency ;
				if ($currentMonth > 12) {
					$currentMonth -= 12 ;
					$currentYear++ ;
				}
			}						
		} else {						
			$currentMonth = date('m', $startTime) ;
			$currentYear = date('Y', $startTime) ;
			while ($startTime < $endTime) {							
				foreach ($monthDays as $day) {
					$nextEventDate = mktime($hour, $minute, 0, $currentMonth, $day, $currentYear); 
					if (($nextEventDate >= $originalStartTime) && ($nextEventDate <= $endTime)) {
						$eventDates[] = strftime('%Y-%m-%d %H:%M:%S', $nextEventDate) ;					
					}
				}
				$currentMonth += $monthlyFrequency ;
				if ($currentMonth > 12) {
					$currentMonth -= 12 ;
					$currentYear++ ;
				}	
				$startTime = mktime(0, 0, 0, $currentMonth, 1, $currentYear);			
			}					
		}	
		return $eventDates ;	
	}		
	function getDeliciousButton( $title, $link ) {	
		$img_url = "components/com_eventbooking/assets/images/socials/delicious.png"; 		
		return '<a href="http://del.icio.us/post?url=' . rawurlencode($link) . '&amp;title=' . rawurlencode( $title ) . '" title="Submit ' . $title . ' in Delicious" target="blank" >
		<img src="' . $img_url . '" alt="Submit ' . $title . ' in Delicious" />
		</a>' ;	
	}	
    function getDiggButton( $title, $link ) {    
        $img_url = "components/com_eventbooking/assets/images/socials/digg.png"; 
        return '<a href="http://digg.com/submit?url=' . rawurlencode($link) . '&amp;title=' . rawurlencode( $title ) . '" title="Submit ' . $title . ' in Digg" target="blank" >
        <img src="' . $img_url . '" alt="Submit ' . $title . ' in Digg" />
        </a>' ;   
    }
    function getFacebookButton( $title, $link ) {    
        $img_url = "components/com_eventbooking/assets/images/socials/facebook.png";         
        return '<a href="http://www.facebook.com/sharer.php?u=' . rawurlencode($link) . '&amp;t=' . rawurlencode( $title ) . '" title="Submit ' . $title . ' in FaceBook" target="blank" >
        <img src="' . $img_url . '" alt="Submit ' . $title . ' in FaceBook" />
        </a>' ;    
    }    
    function getGoogleButton( $title, $link ) {    
        $img_url = "components/com_eventbooking/assets/images/socials/google.png";         
        return '<a href="http://www.google.com/bookmarks/mark?op=edit&bkmk=' . rawurlencode($link) . '" title="Submit ' . $title . ' in Google Bookmarks" target="blank" >
        <img src="' . $img_url . '" alt="Submit ' . $title . ' in Google Bookmarks" />
        </a>' ;    
    }    
    function getStumbleuponButton( $title, $link ) {    
        $img_url = "components/com_eventbooking/assets/images/socials/stumbleupon.png";         
        return '<a href="http://www.stumbleupon.com/submit?url=' . rawurlencode($link) . '&amp;title=' . rawurlencode( $title ) . '" title="Submit ' . $title . ' in Stumbleupon" target="blank" >
        <img src="' . $img_url . '" alt="Submit ' . $title . ' in Stumbleupon" />
        </a>' ;    
    }    
    function getTechnoratiButton( $title, $link ) {    
        $img_url = "components/com_eventbooking/assets/images/socials/technorati.png";         
        return '<a href="http://technorati.com/faves?add=' . rawurlencode($link) . '" title="Submit ' . $title . ' in Technorati" target="blank" >
        <img src="' . $img_url . '" alt="Submit ' . $title . ' in Technorati" />
        </a>' ;
    }    
    function getTwitterButton( $title, $link ) {    
        $img_url = "components/com_eventbooking/assets/images/socials/twitter.png";         
        return '<a href="http://twitter.com/?status=' . rawurlencode( $title ." ". $link ) . '" title="Submit ' . $title . ' in Twitter" target="blank" >
        <img src="' . $img_url . '" alt="Submit ' . $title . ' in Twitter" />
        </a>' ;    
    }	

    /**
     * Add submenus, only used for Joomla 1.6
     * 
     * @param string $vName
     */
    function addSubMenus($vName = 'events') {			
		JSubMenuHelper::addEntry(
			JText::_('Configuration'),
			'index.php?option=com_eventbooking&view=configuration',
			$vName == 'configuration'
		);
		JSubMenuHelper::addEntry(
			JText::_('Categories'),
			'index.php?option=com_eventbooking&view=categories',
			$vName == 'forms'
		);
		JSubMenuHelper::addEntry(
			JText::_('Events'),
			'index.php?option=com_eventbooking&view=events',
			$vName == 'events'
		);				
		JSubMenuHelper::addEntry(
			JText::_('Registrants'),
			'index.php?option=com_eventbooking&view=registrants',
			$vName == 'registrants'
		);
		JSubMenuHelper::addEntry(
			JText::_('Custom Fields'),
			'index.php?option=com_eventbooking&view=fields',
			$vName == 'fields'
		);
		JSubMenuHelper::addEntry(
			JText::_('Locations'),
			'index.php?option=com_eventbooking&view=locations',
			$vName == 'locations'
		);
		JSubMenuHelper::addEntry(
			JText::_('Coupons'),
			'index.php?option=com_eventbooking&view=coupons',
			$vName == 'coupons'
		);
		JSubMenuHelper::addEntry(
			JText::_('Payment Plugins'),
			'index.php?option=com_eventbooking&view=plugins',
			$vName == 'plugins'
		);
		JSubMenuHelper::addEntry(
			JText::_('Translation'),
			'index.php?option=com_eventbooking&view=language',
			$vName == 'language'
		);							
		JSubMenuHelper::addEntry(
			JText::_('Export Registrants'),
			'index.php?option=com_eventbooking&task=csv_export',
			false
		);
		JSubMenuHelper::addEntry(
			JText::_('Waiting List'),
			'index.php?option=com_eventbooking&view=waitings',
			$vName == 'waitings'
		);			
		JSubMenuHelper::addEntry(
			JText::_('Mass Mail'),
			'index.php?option=com_eventbooking&view=massmail',
			$vName == 'massmail'
		);	
	}    
}
?>